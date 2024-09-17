<?php

	namespace App\Http\Controllers;

	use App\Mail\PriceNotFound;
	use App\Mail\ResponseEmail;
    use App\Models\Config;
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

			try  {
				$response = $this->processInformationByAi($body);
				$query = $this->getTransportRates($response);

				$data = LogModel::create([
					'message' => 'Email saved',
					'context' => json_encode($req),
					'response' => $response,
				]);

				Log::info('Data saved', ['data' => $data]);
                Log::info('Query chatGPT', ['data' => $query]);

				//$queryData = json_decode($query->getContent(), true);

				//$dataArray = $queryData['data'];
				$pptoResponse = $this->processQueryData($query, $body);

				Mail::to($email)->send(new ResponseEmail($pptoResponse));

				return response()->json(['message' => 'data saved', 'data' => $data, 'query' => $query, 'Respuesta AI' => $pptoResponse], 201);
			} catch (\Exception $e) {
				Log::error('Error saving email', ['error' => $e->getMessage()]);

				Mail::to($email)->send(new PriceNotFound());

				return response()->json(['message' => 'error saving data'], 500);
			}
		}

		public function processInformationByAi($body) {
			Log::error('response before', ['data' => $body]);
            $config = Config::first();
            $prompt = $config ? $config->prompt : '';

            $prompt = str_replace('$body', $body, $prompt);

            Log::info('Prompt DB', ['data' => $prompt]);

			$result = OpenAI::chat()->create([
				'model' => 'gpt-4o-mini',
				'messages' => [
					[
						'role' => 'user',
						'content' => $prompt,
					],
				],
			]);

            $responseContent = $result->choices[0]->message->content;
            Log::info('response saved', ['data' => $responseContent]);

            // Extract SQL query using regex
            preg_match('/```sql(.*?)```/s', $responseContent, $matches);
            $sqlQuery = isset($matches[1]) ? trim($matches[1]) : '';

            return $sqlQuery;
			//return $result->choices[0]->message->content;
		}

		public function processQueryData($query, $body) {
			Log::error('response before', ['data' => $query]);
            $today = date('Y-m-d');
            $dateExpire = date('Y-m-d', strtotime($today . ' + 7 days'));

			$result = OpenAI::chat()->create([
				'model' => 'gpt-4o-mini',
				'messages' => [
					[
						'role' => 'user',
                        'content' => '
                            A partir de los datos proporcionados en el array' . $query . ', formatea la respuesta para una cotización de transporte según el siguiente formato en HTML:
                            En caso de haber articulos llena la tabla de articulos, en caso de no haber articulos no mostrar la tabla de articulos.
                            Deduce desde '.$body.' los datos necesarios para completar la cotización. Los datos que no esten en el array deben ser reemplazados por "No espeficado" .
                            Elimina las expresiones ```html y las notas creadas por ti, solo necesitamos el contenido HTML.

                            <div class="response-ai">
                                <div style="margin-bottom: 50px;">
                                    <ul style="list-style-type: none; padding: 0px;">
                                        <li>Fecha de emisión: '.$today.' </li>
                                        <li>Fecha de vigencia: '.$dateExpire.'</li>
                                        <li>Dirección de entrega (impor): [dirección de entrega]</li>
                                        <li>Puerto de origen: </li>
                                        <li>Puerto de destino: [puerto de destino]</li>
                                        <li>Tipo de servicio: FCL 20" / FLC 40" STD / FLC 40" HC </li>
                                        <li>Peso de la carga: [peso de la carga]</li>
                                        <li>Descripción de la mercancía: [descripción de la mercancía]</li>
                                        <li>Naviera: [naviera]</li>
                                    </ul>
                                </div>

                                <div style="margin-bottom: 50px;">
                                    <!-- Tabla de tarifas -->
                                    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                                        <thead>
                                            <tr style="background-color: #f2f2f2;">
                                                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Descripción</th>
                                                <th style="padding: 10px; text-align: right; border-bottom: 2px solid #ddd;">Cantidad</th>
                                                <th style="padding: 10px; text-align: right; border-bottom: 2px solid #ddd;">Tarifa</th>
                                                <th style="padding: 10px; text-align: right; border-bottom: 2px solid #ddd;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Repite esta estructura para cada ítem -->
                                            <tr>
                                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">[Descripción]</td>
                                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">[Cantidad]</td>
                                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">[Tarifa]</td>
                                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">[Total]</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fin de tabla de tarifas -->
                                <!-- Tabla de articulo -->
                                <div style="margin-bottom: 50px;">
                                    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                                        <thead>
                                            <tr style="background-color: #f2f2f2;">
                                                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Descripción de artículo</th>
                                                <th style="padding: 10px; text-align: right; border-bottom: 2px solid #ddd;">Cantidad</th>
                                                <th style="padding: 10px; text-align: right; border-bottom: 2px solid #ddd;">Tarifa</th>
                                                <th style="padding: 10px; text-align: right; border-bottom: 2px solid #ddd;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Repite esta estructura para cada ítem -->
                                            <tr>
                                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">[Descripción de artículo]</td>
                                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">[Cantidad]</td>
                                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">[Tarifa]</td>
                                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">[Total]</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fin de tabla de totales -->
                            </div>
                        ',
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

				$data = array_map(function ($item) {
					return (array)$item;
				}, $results);

				Log::info('Datos de query', ['query' => $data]);

				return response()->json(['data' => $data], 200);
			} catch (\Exception $e) {
				Log::error('Error executing query', ['error' => $e->getMessage(), 'query' => $query]);
				return response()->json(['message' => 'error executing query'], 500);
			}
		}
	}
