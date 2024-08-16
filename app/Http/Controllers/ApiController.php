<?php

namespace App\Http\Controllers;

use App\Mail\PriceNotFound;
use App\Mail\ResponseEmail;
use App\Models\Log as LogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use OpenAI\Laravel\Facades\OpenAI;

class ApiController extends Controller {
    public function save(Request $request) {
        $req = $request->all();
        $body = $req['data']['body'] ?? '';
        $email = $req['data']['email'] ?? '';

        try {
            $response = $this->processInformationByAi($body);
            $query = $this->getTransportRates($response);

            $data = LogModel::create([
                'message' => 'Email saved',
                'context' => json_encode($req),
                'response' => $response,
            ]);

            Log::info('Data saved', ['data' => $data, 'query' => $query]);

            // Decode the query response to pass the data array to the mailable
            $queryData = json_decode($query->getContent(), true);

            // Access the data from the stdClass object
            $dataArray = $queryData['data'];

            Mail::to($email)->send(new ResponseEmail($dataArray));

            return response()->json(['message' => 'data saved', 'data' => $data, 'Query' => $query], 201);
        } catch (\Exception $e) {
            Log::error('Error saving email', ['error' => $e->getMessage()]);

            Mail::to($email)->send(new PriceNotFound());

            return response()->json(['message' => 'error saving data'], 500);
        }
    }

    public function processInformationByAi($body) {
        Log::error('response before', ['data' => $body]);

        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "
                    Toma este requerimiento". $body ."
                    te dejo un ejemplo de query correcta SELECT origen, destino, tipo_de_transporte, tarifa_de_transporte_base, tarifa_usd_kg, margen_aplicado FROM transport_rates WHERE (origen = 'Manzanillo' OR origen = 'Puntarenas' OR origen = 'Limon') AND destino = 'Savannha, GA Port, USA' AND fecha_de_vigencia IS NOT NULL;
                    detecta los campo mas importantes y revisa la estructura.
                    y  Tengo la siguiente estructura de tabla en MySQL:
                    -  Nombre de la tabla es transport_rates
                    - origen (string, nullable)
                    - destino (string, nullable)
                    - tipo_de_transporte (string, [Marítimo, Aéreo, Terrestre], nullable)
                    - tarifa_de_transporte_base (decimal(10, 2), nullable)
                    - tarifa_usd_kg (decimal(10, 2), nullable)
                    - margen_aplicado (decimal(5, 2), nullable)
                    - id_del_envio (string, nullable)
                    - fecha_de_vigencia (date, nullable)
                    En base a la requerimiento  devuelve solo la query para ejecutar.
                    Evita agregar texto que no sea la query"
                ],
            ],
        ]);


        Log::info('response saved', ['data' => $result->choices[0]->message->content]);
        return $result->choices[0]->message->content;
    }

    public function getTransportRates(string $query) {
        try {
            $cleanedQuery = str_replace(["```sql", "```", "\\'"], "", $query);
            $cleanedQuery = trim($cleanedQuery);

            Log::info('Executing query', ['query' => $cleanedQuery]);
            $results = DB::select($cleanedQuery);

            // Ensure results are not empty
            if (empty($results)) {
                return response()->json(['message' => 'No data available'], 200);
            }

            // Extract the data field
            $data = array_map(function($item) {
                return (array) $item;
            }, $results);

            Log::info('Datos de query', ['query' => $data]);

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            Log::error('Error executing query', ['error' => $e->getMessage(), 'query' => $query]);
            return response()->json(['message' => 'error executing query'], 500);
        }
    }
}
