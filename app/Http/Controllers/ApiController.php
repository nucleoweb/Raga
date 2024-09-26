<?php

	namespace App\Http\Controllers;

	use App\Mail\CityOutOfRange;
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

            try {
                $response = $this->promptProces01($body);
                $data = collect($response);
                $type = $data->get('data')['tipo_transporte'];
                $missingFields = $data->get('data')['campos_faltantes'];
                $countMissingFields = is_array($missingFields) ? count($missingFields) : 0;
                $dataForQuery = $data->get('data');
                $ciudadDestino = $data->get('data')['unlocation_id'];

                Log::info('Unlocation ID', ['ciudad' => $ciudadDestino]);

                if (!$this->validarCiudad($ciudadDestino)) {
                    Mail::to($email)->send(new CityOutOfRange($ciudadDestino));
                    return response()->json(['Ciudad fuera de rango' => $ciudadDestino], 201);
                }

                if ($countMissingFields > 0) {
                    $this->sendPriceNotFoundEmail($email, $missingFields);
                    return response()->json(['Faltan los siguientes campos' => $missingFields], 201);
                } else {
                    if ($type === 'FCL') {
                        return $this->handleFcl($dataForQuery, $email);
                    } else {
                        return $this->handleFtl($dataForQuery, $email);
                    }
                }

            } catch (\Exception $e) {
                Log::error('Error Proceso', ['error' => $e->getMessage()]);
                $this->sendPriceNotFoundEmail($email);
                return response()->json(['message' => 'error saving data'], 500);
            }
		}

        private function validarCiudad($ciudad) {
            Log::info('validar ciudad', ['ciudad' => $ciudad]);

            $ciudadesPermitidas = [
                "Alajuela", "Aserrí", "Brisas", "Cartago", "Coronado", "Coyol",
                "Heredia", "Ipis", "Naranjo", "Palmares", "San José", "Santa Ana",
                "Tres Ríos de Cartago"
            ];

            $ciudad = str_replace(", Costa Rica", "", $ciudad);

            if (in_array($ciudad, $ciudadesPermitidas)) {
                return true;
            } else {
                return false;
            }
        }

        private function handleFcl($data, $email) {
            $query = $this->promptFclQuery($data);
            $response = $this->processQuery($query);
            Log::info('Process Query FCL', ['response' => $response]);

            try {
                $fclProcess = $this->procesResults($query, $data);
                $this->sendResponseEmail($email, $fclProcess);

            } catch (\Exception $e) {
                Log::error('Error Proceso FCL', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'error saving data'], 500);
            }

            return response()->json(['Response FCL query' => $query, "Response Process Query" => $response], 201);
        }

        private function handleFtl($data, $email) {
            Log::info('FTL json', ['data' => $data]);
            $query = $this->promptFtlQuery($data);
            $response = $this->processQuery($query);
            return response()->json(['Response FTL query' => $query, "Response Process Query" => $response], 201);
        }

        private function sendPriceNotFoundEmail($email, $missingFields = []) {
            Mail::to($email)->send(new PriceNotFound($missingFields));
        }

        private function sendResponseEmail($email, $data) {
            Mail::to($email)->send(new ResponseEmail($data));
        }

        public function promptProces01($body) {
            $config = Config::first();
            $prompt = $config ? $config->prompt : '';
            $prompt = str_replace('$body', $body, $prompt);

            $result = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'temperature' => 0.3,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
            ]);

            $responseContent = $result->choices[0]->message->content;
            Log::info('Response raw 01', [$responseContent]);

            // Extract JSON content using regex
            preg_match('/```json(.*?)```/s', $responseContent, $matches);
            $jsonContent = isset($matches[1]) ? trim($matches[1]) : '';

            // Ensure $jsonContent is a string before decoding
            if (is_string($jsonContent) && !empty($jsonContent)) {
                $responseData = json_decode($jsonContent, true);
            } else {
                $responseData = null;
            }

            return $responseData;
        }

        public function promptFclQuery($body) {
            Log::info('Prompt FCL Query', ['body' => $body]);

            try {
                $result = OpenAI::chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => "
                            Transforma ". json_encode($body) ." en un query SQL
                            El siguiente SQL calcula el costo por contenedor para FCL basándose en el puerto de destino, la naviera, la ciudad de destino y la cantidad de contenedores que se están cotizando. Este cálculo se realiza por tipo de contenedor, es decir, para contenedores de 40 pies o 20 pies, y separa las tarifas de cada uno.
                            Responde solo la query sql para poder ejecutarla en otra funcion

                            -- Cotización para contenedores FCL
                            SELECT
                                CONCAT('Total Contenedores (', '40HQ', ')') AS descripcion,
                                {cantidad_contenedores_40HQ} AS cantidad,
                                SUM(
                                    COALESCE(
                                        (SELECT SUM(cost)
                                         FROM port_charges
                                         WHERE pod = '{pod}' -- Puerto dinámico
                                           AND carrier = '{carrier}' -- Naviera dinámica
                                           AND product_type = 'FCL'
                                           AND supplier_charge_name LIKE '%IMPO%'), 0)
                                    +
                                    COALESCE(
                                        (SELECT MIN(cost)
                                         FROM land_charges
                                         WHERE port_cfs_airport_name = '{pod}' -- Puerto dinámico
                                           AND unlocation_id = '{unlocation_id}' -- Ciudad de destino dinámica
                                           AND (allowed_carriers LIKE '%{carrier}%' OR allowed_carriers IS NULL)
                                           AND product_type = 'FCL'
                                           AND supplier_charge_name LIKE '%IMPO%'), 0)
                                ) AS tarifa_por_contenedor,
                                (SELECT MAX(handling_fee) * {cantidad_contenedores_40HQ}
                                 FROM margins
                                 WHERE product_type = 'FCL') AS handling_fee, -- Calcula el handling fee por cantidad de contenedores
                                (SELECT MAX(documentation_fee)
                                 FROM margins
                                 WHERE product_type = 'FCL') AS documentation_fee -- Se aplica una sola vez por cotización
                            FROM
                                (SELECT 1) AS dummy_table;

                            -- Cotización para contenedores de 20 pies
                            SELECT
                                CONCAT('Total Contenedores (', '20FT', ')') AS descripcion,
                                {cantidad_contenedores_20FT} AS cantidad,
                                SUM(
                                    COALESCE(
                                        (SELECT SUM(cost)
                                         FROM port_charges
                                         WHERE pod = '{pod}' -- Puerto dinámico
                                           AND carrier = '{carrier}' -- Naviera dinámica
                                           AND product_type = 'FCL'
                                           AND supplier_charge_name LIKE '%IMPO%'), 0)
                                    +
                                    COALESCE(
                                        (SELECT MIN(cost)
                                         FROM land_charges
                                         WHERE port_cfs_airport_name = '{pod}' -- Puerto dinámico
                                           AND unlocation_id = '{unlocation_id}' -- Ciudad de destino dinámica
                                           AND (allowed_carriers LIKE '%{carrier}%' OR allowed_carriers IS NULL)
                                           AND product_type = 'FCL'
                                           AND supplier_charge_name LIKE '%IMPO%'), 0)
                                ) AS tarifa_por_contenedor,
                                (SELECT MAX(handling_fee) * {cantidad_contenedores_20FT}
                                 FROM margins
                                 WHERE product_type = 'FCL') AS handling_fee, -- Calcula el handling fee por cantidad de contenedores
                                (SELECT MAX(documentation_fee)
                                 FROM margins
                                 WHERE product_type = 'FCL') AS documentation_fee -- Se aplica una sola vez por cotización
                            FROM
                                (SELECT 1) AS dummy_table;

                            -- Cargos por transportista terrestre (land charges), diferenciando entre inland carrier e inland merchant
                            SELECT
                                'Land Charges (Inland Carrier)' AS descripcion,
                                COALESCE(
                                    (SELECT MIN(cost)
                                     FROM land_charges
                                     WHERE port_cfs_airport_name = '{pod}'
                                       AND unlocation_id = '{unlocation_id}'
                                       AND allowed_carriers LIKE '%{carrier}%'
                                       AND product_type = 'FCL'), 0) AS inland_carrier_cost,
                                COALESCE(
                                    (SELECT MIN(cost)
                                     FROM land_charges
                                     WHERE port_cfs_airport_name = '{pod}'
                                       AND unlocation_id = '{unlocation_id}'
                                       AND allowed_carriers IS NULL
                                       AND product_type = 'FCL'), 0) AS inland_merchant_cost -- Si no hay carrier permitido
                            FROM
                                (SELECT 1) AS dummy_table;
                        ",
                        ],
                    ],
                ]);

                $responseContent = $result->choices[0]->message->content;
                return $responseContent;
            } catch (\Exception $e) {
                Log::error('Error Prompt FCL Query', ['error' => $e->getMessage()]);
                return '';
            }
        }

        public function promptFtlQuery($body) {
            $result = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'temperature' => 0.9,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "
                            Transforma ".$body. " en un query SQL
                            El siguiente SQL calcula el costo total por contenedor para FTL basándose en la ciudad de origen, la ciudad de destino y la cantidad de contenedores. Este cálculo se realiza utilizando solo los cargos terrestres (land_charges) correspondientes.
                            Responde solo la query sql para poder ejecutarla en otra funcion

                            -- Cotización para transporte FTL
                            SELECT
                                CONCAT('Total Transporte (', '{ciudad_origen}', ' - ', '{ciudad_destino}', ')') AS descripcion,
                                {cantidad_contenedores} AS cantidad,
                                SUM(
                                    COALESCE(
                                        (SELECT MIN(cost)
                                         FROM land_charges
                                         WHERE port_cfs_airport_name = '{ciudad_origen}'
                                           AND unlocation_id = '{ciudad_destino}'
                                           AND product_type = 'FTL'), 0)
                                ) AS tarifa_por_contenedor
                            FROM
                                (SELECT 1) AS dummy_table;
                        ",
                    ],
                ],
            ]);

            $responseContent = $result->choices[0]->message->content;
            return $responseContent;
        }

		public function processInformationByAi($body) {
            $config = Config::first();
            $prompt = $config ? $config->prompt : '';
            $prompt = str_replace('$body', $body, $prompt);

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

            // Extract SQL query using regex
            //preg_match('/```sql(.*?)```/s', $responseContent, $matches);
            //$sqlQuery = isset($matches[1]) ? trim($matches[1]) : '';

            return $responseContent;
			//return $result->choices[0]->message->content;
		}

		public function procesResults($query, $body) {
            $config = Config::first();
            $prompt = $config ? $config->departure_prompt : '';

            $today = date('Y-m-d');
            $dateExpire = date('Y-m-d', strtotime($today . ' + 7 days'));

            $prompt = str_replace('$body', json_encode($body), $prompt);
            $prompt = str_replace('$query', json_encode($query), $prompt);
            $prompt = str_replace('$today', $today, $prompt);
            $prompt = str_replace('$dateExpire', $dateExpire, $prompt);

			$result = OpenAI::chat()->create([
				'model' => 'gpt-4o-mini',
				'messages' => [
					[
						'role' => 'user',
                        'content' => $prompt,
					],
				],
			]);

			Log::info('response saved', ['data' => $result->choices[0]->message->content]);
			return $result->choices[0]->message->content;
		}

		public function processQuery(string $query) {
            Log::info('Process Query', ['response' => $query]);
            try {
                $cleanedQuery = str_replace(["```sql", "```", "\\'"], "", $query);
                $cleanedQuery = trim($cleanedQuery);

                $queries = explode(';', $cleanedQuery);
                $results = [];

                foreach ($queries as $singleQuery) {
                    $singleQuery = trim($singleQuery);
                    if (!empty($singleQuery)) {
                        Log::info('Executing query', ['query' => $singleQuery]);
                        $result = DB::select($singleQuery);
                        $results = array_merge($results, $result);
                    }
                }

                if (empty($results)) {
                    return response()->json(['message' => 'No data available'], 200);
                }

                $data = array_map(function ($item) {
                    return (array)$item;
                }, $results);

                return response()->json(['data' => $data], 200);
            } catch (\Exception $e) {
                Log::error('Error executing query', ['error' => $e->getMessage(), 'query' => $query]);
                return response()->json(['message' => 'error executing query'], 500);
            }
		}
	}
