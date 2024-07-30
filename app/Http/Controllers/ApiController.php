<?php

namespace App\Http\Controllers;

use App\Mail\ResponseEmail;
use App\Models\Log as LogModel;
use Illuminate\Http\Request;
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

            $data = LogModel::create([
                'message' => 'Email saved',
                'context' => json_encode($req),
                'response' => $response
            ]);

            Log::info('Data saved', ['data' => $data]);

            Mail::to($email)->send(new ResponseEmail($response));

            return response()->json(['message' => 'data saved', 'data' => $data], 201);
        } catch (\Exception $e) {
            Log::error('Error saving email', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'error saving data'], 500);
        }
    }

    public function processInformationByAi($body) {
        Log::error('response before', ['data' => $body]);

        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => "Toma este requerimiento". $body ." y detecta los siguientes campos: 1. Origen, 2. Destino, 3. Tamaño del contenedor, 4. Peso, 5. Condiciones especiales. Entrega los datos ordenados"],
            ],
        ]);


        Log::info('response saved', ['data' => $result->choices[0]->message->content]);
        return $result->choices[0]->message->content;
    }
}
