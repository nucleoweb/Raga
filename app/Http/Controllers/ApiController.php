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
            //$query = $this->getTransportRates($response);

            $data = LogModel::create([
                'message' => 'Email saved',
                'context' => json_encode($req),
                'response' => $response,
            ]);

            Log::info('Data saved', ['data' => $data]);

            //$queryData = json_decode($query->getContent(), true);

            //$dataArray = $queryData['data'];

            Mail::to($email)->send(new ResponseEmail($response));

            return response()->json(['message' => 'data saved', 'data' => $data], 201);
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
                    'content' =>
			    "Toma este requerimiento: $body .
			Detecta dentro del texto los siguientes campos:
			- Ciudad y/o puerto de origen
			- Ciudad y/o puerto destino
			- Tipo de transporte (terrestre, marítimo, aéreo)
			- Peso de la carga
			- Naviera o carrier (si se menciona)
			La cotización se compone de: Costos de puerto (port charges), costos de transporte (transport charges), los cuales se se aplica una política de magen del 18%, y luego se suma. Si no tienes accesos a una base de datos, simula los costos y entrega la cotización.
			Estructura tu respuesta como si fuera una cotización formal por correo electrónico, no muestres los cálculos, solo muestra los totales por categoría. No muestres el margen en la respuesta, es información que el cliente no debe ver, sólo calcula los costos con el margen aplicado y ese monto total por categoría es la respuesta que debes dar
			En caso de no detectar alguno de los campos, por favor, solicita la información faltante.
			Si hay información adicional que consideres relevante para la cotización, indícalo o pregúntalo también.
			Realiza una consulta en la base de datos para obtener los costos necesarios para cotizar el transporte según la información detectada.
			**Nota:** Si recibes una solicitud que no sea una cotización de transporte, contesta brevemente la pregunta que te hayan hecho y luego indica que eres un agente especializado en cotizaciones de transporte internacional.
			En caso de no tener acceso a la db simula un precio aproximado. Esto es solo una referencia para una prueba de concepto."
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

            if (empty($results)) {
                return response()->json(['message' => 'No data available'], 200);
            }

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
