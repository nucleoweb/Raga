<?php

	namespace App\Http\Controllers;

	use App\Mail\CityOutOfRange;
    use App\Mail\PriceNotFound;
	use App\Mail\ResponseEmail;
    use App\Models\Config;
    use App\Models\Log as LogModel;
    use Illuminate\Http\JsonResponse;
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
            Log::info('Request Email', ['email' => $req['data']]);

            try {
                $response = $this->promptProces01($body);
                Log::info('Prompt Process ', ['prompt' => $response]);
                $data = collect($response);
                $type = $data->get('data')['tipo_transporte'];
                $missingFields = $data->get('data')['campos_faltantes'];
                $countMissingFields = is_array($missingFields) ? count($missingFields) : 0;
                $dataForQuery = $data->get('data');
                $ciudadDestino = $data->get('data')['unlocation_id'];
                $dataForQuery['unlocation_id'] = $ciudadDestino;

                Log::info('Unlocation ID', ['ciudad' => $ciudadDestino, 'data for query' => $dataForQuery]);

                if ($type === 'FCL') {
                    if (!$this->validarCiudadFcl($ciudadDestino)) {
                        Mail::to($email)->send(new CityOutOfRange($ciudadDestino));
                        return response()->json(['Ciudad fuera de rango' => $ciudadDestino], 201);
                    }
                }

                if ($countMissingFields > 0) {
                    $this->sendPriceNotFoundEmail($email, $missingFields);
                    return response()->json(['Faltan los siguientes campos' => $missingFields], 201);
                } else {
                    if ($type === 'FCL') {
                        return $this->handleFcl($dataForQuery, $email, $data);
                    } else {
                        return $this->handleFtl($dataForQuery, $email, $data);
                    }
                }

            } catch (\Exception $e) {
                Log::error('Error Proceso', ['error' => $e->getMessage()]);
                $this->sendPriceNotFoundEmail($email);
                return response()->json(['message' => 'error saving data'], 500);
            }
		}

        private function validarCiudadFcl($ciudad) {
            Log::info('validar ciudad FCL', ['ciudad' => $ciudad]);

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

        private function validarCiudadFtl($data) {
            Log::info('validar ciudad FTL', ['data' => $data]);

            $ciudadesDeOrigen = [
                "Alajuela", "Cartago", "Ciudad de Guatemala", "Ciudad de Panama",
                "Ciudad Hidalgo", "Coyol", "Heredia", "Managua", "San Jose",
                "San Pedro Sula", "San Salvador", "Guatemala"
            ];

            $ciudadesDeDestino = [
                "Alajuela", "Cartago", "Ciudad de Guatemala", "Ciudad de Panama",
                "Ciudad Hidalgo", "Coyol", "Heredia", "Managua", "San Jose",
                "San Pedro Sula", "San Salvador", "Tegucigalpa"
            ];

            // Extraer solo la ciudad de origen
            $ciudadOrigen = preg_replace('/, .*/', '', $data['ciudad_origen']);
            $ciudadDestino = preg_replace('/, .*/', '', $data['unlocation_id']);

            $origenValido = in_array($ciudadOrigen, $ciudadesDeOrigen);
            $destinoValido = in_array($ciudadDestino, $ciudadesDeDestino);

            return $origenValido && $destinoValido;
        }

        private function handleFcl($data, $email, $arr) {
            $query = $this->promptFclQuery($data);
            $response = $this->processQuery($query);
            Log::info('Process Query FCL', ['response' => $response]);

            try {
                $collection = $this->transformResponseToCollection($response);
                $cleanedFclProcess = $this->cleanFclData($collection);
                $this->sendResponseEmail($email, $cleanedFclProcess, $arr);

            } catch (\Exception $e) {
                Log::error('Error Proceso FCL', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'error saving data'], 500);
            }

            return response()->json(['Response FCL query' => $query, "Response Process Query" => $response], 201);
        }

        private function handleFtl($data, $email) {
            $query = $this->promptFtlQuery($data);
            $response = $this->processQuery($query);

            try {
                $collection = $this->transformResponseToCollection($response);
                $cleanedFtlProcess = $this->cleanFclData($collection);
                Log::info('Clean FTL', ['response' => $cleanedFtlProcess]);
                $this->sendResponseEmail($email, $cleanedFtlProcess);

            } catch (\Exception $e) {
                Log::error('Error Proceso FTL', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'error saving data'], 500);
            }
            return response()->json(['Response FTL query' => $query, "Response Process Query" => $response], 201);
        }

        private function transformResponseToCollection(JsonResponse $response) {
            $data = json_decode($response->getContent(), true);
            return collect($data['data']);
        }

        private function cleanFclData(\Illuminate\Support\Collection $collection) {
            Log::info('Table collection', ['response' => $collection]);
            $table = '<table border="0" style="border-collapse: collapse; width: 100%;">';
            $table .= '<thead style="background-color: #cccccc;"><tr><th>Descripción</th><th>Cantidad</th><th>Costo por Unidad</th><th>Costo Total</th></tr></thead>';
            $table .= '<tbody>';

            foreach ($collection as $item) {
                // Decode the JSON string
                $decodedItem = json_decode(reset($item), true);

                $descripcion = isset($decodedItem['descripcion']) ? htmlspecialchars($decodedItem['descripcion']) : '';
                $cantidad = isset($decodedItem['cantidad']) ? htmlspecialchars($decodedItem['cantidad']) : '';
                $costoPorUnidad = isset($decodedItem['costo_por_unidad']) ? htmlspecialchars($decodedItem['costo_por_unidad']) : '';
                $costoTotal = isset($decodedItem['costo_total']) ? htmlspecialchars($decodedItem['costo_total']) : '';

                $table .= '<tr>';
                $table .= '<td>' . $descripcion . '</td>';
                $table .= '<td>' . $cantidad . '</td>';
                $table .= '<td>' . $costoPorUnidad . '</td>';
                $table .= '<td>' . $costoTotal . '</td>';
                $table .= '</tr>';
            }

            $table .= '</tbody></table>';
            return $table;
        }

        private function sendPriceNotFoundEmail($email, $missingFields = []) {
            Mail::to($email)->send(new PriceNotFound($missingFields));
        }

        private function sendResponseEmail($email, $data, $arr) {
            $data = ['response' => $data];
            Mail::to($email)->send(new ResponseEmail($data, $arr));
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

                            -- Cálculo completo de costos FCL incluyendo Port Charges, Land Charges, Handling Fee, y Documentation Fee

                            -- Port Charges para contenedores de 40HC
                            SELECT JSON_OBJECT(
                                'descripcion', 'Total Contenedores (40HC)',
                                'cantidad', cantidad_contenedores_40HQ, -- Toma del JSON: cantidad_contenedores_40HQ
                                'costo_por_unidad', COALESCE(
                                    (SELECT SUM(cost)
                                     FROM port_charges
                                     WHERE pod LIKE CONCAT('%', pod, '%') -- Toma del JSON: pod
                                       AND carrier LIKE CONCAT('%', carrier, '%') -- Toma del JSON: carrier
                                       AND product_type = 'FCL'
                                       AND supplier_charge_name LIKE '%IMPO%'), 0),
                                'costo_total', COALESCE(
                                    (SELECT SUM(cost)
                                     FROM port_charges
                                     WHERE pod LIKE CONCAT('%', pod, '%')
                                       AND carrier LIKE CONCAT('%', carrier, '%')
                                       AND product_type = 'FCL'
                                       AND supplier_charge_name LIKE '%IMPO%'), 0) * cantidad_contenedores_40HQ
                            ) AS port_charges_40HC

                            UNION ALL

                            -- Port Charges para contenedores de 20FT
                            SELECT JSON_OBJECT(
                                'descripcion', 'Total Contenedores (20FT)',
                                'cantidad', cantidad_contenedores_20FT, -- Toma del JSON: cantidad_contenedores_20FT
                                'costo_por_unidad', COALESCE(
                                    (SELECT SUM(cost)
                                     FROM port_charges
                                     WHERE pod LIKE CONCAT('%', pod, '%')
                                       AND carrier LIKE CONCAT('%', carrier, '%')
                                       AND product_type = 'FCL'
                                       AND supplier_charge_name LIKE '%IMPO%'), 0),
                                'costo_total', COALESCE(
                                    (SELECT SUM(cost)
                                     FROM port_charges
                                     WHERE pod LIKE CONCAT('%', pod, '%')
                                       AND carrier LIKE CONCAT('%', carrier, '%')
                                       AND product_type = 'FCL'
                                       AND supplier_charge_name LIKE '%IMPO%'), 0) * cantidad_contenedores_20FT
                            ) AS port_charges_20FT

                            UNION ALL

                            -- Land Charges: seleccionar el costo más bajo entre Inland Carrier e Inland Merchant (sólo para carriers específicos)
                            SELECT JSON_OBJECT(
                                'descripcion', 'Land Charges',
                                'tipo',
                                    CASE
                                        WHEN carrier IN ('Maersk', 'Hapag Lloyd', 'Cosco') THEN
                                            CASE
                                                WHEN
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%') -- Toma del JSON: pod
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%') -- Toma del JSON: unlocation_id
                                                       AND allowed_carriers LIKE CONCAT('%', carrier, '%') -- Toma del JSON: carrier
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Carrier')
                                                    <=
                                                    (COALESCE(
                                                        (SELECT MIN(cost)
                                                         FROM land_charges
                                                         WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                           AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                           AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                           AND product_type = 'FCL'
                                                           AND charge_type = 'Inland Merchant'
                                                           AND trucker IS NULL), 0)
                                                    + COALESCE(
                                                        (SELECT MIN(cost)
                                                         FROM land_charges
                                                         WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                           AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                           AND product_type = 'FCL'
                                                           AND charge_type = 'Inland Merchant'
                                                           AND trucker LIKE '%Amacavi%'), 0))
                                                THEN 'Inland Carrier'
                                                ELSE 'Inland Merchant'
                                            END
                                        ELSE 'Inland Carrier'
                                    END,
                                'cantidad', 1,
                                'costo_por_unidad',
                                    CASE
                                        WHEN carrier IN ('Maersk', 'Hapag Lloyd', 'Cosco') THEN
                                            LEAST(
                                                COALESCE((SELECT MIN(cost)
                                                 FROM land_charges
                                                 WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                   AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                   AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                   AND product_type = 'FCL'
                                                   AND charge_type = 'Inland Carrier'), 0),
                                                COALESCE(
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                       AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Merchant'
                                                       AND trucker IS NULL), 0)
                                                + COALESCE(
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Merchant'
                                                       AND trucker LIKE '%Amacavi%'), 0)
                                            )
                                        ELSE
                                            COALESCE((SELECT MIN(cost)
                                             FROM land_charges
                                             WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                               AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                               AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                               AND product_type = 'FCL'
                                               AND charge_type = 'Inland Carrier'), 0)
                                    END,
                                'costo_total',
                                    CASE
                                        WHEN carrier IN ('Maersk', 'Hapag Lloyd', 'Cosco') THEN
                                            LEAST(
                                                COALESCE((SELECT MIN(cost)
                                                 FROM land_charges
                                                 WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                   AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                   AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                   AND product_type = 'FCL'
                                                   AND charge_type = 'Inland Carrier'), 0),
                                                COALESCE(
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                       AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Merchant'
                                                       AND trucker IS NULL), 0)
                                                + COALESCE(
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Merchant'
                                                       AND trucker LIKE '%Amacavi%'), 0)
                                            )
                                        ELSE
                                            COALESCE((SELECT MIN(cost)
                                             FROM land_charges
                                             WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                               AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                               AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                               AND product_type = 'FCL'
                                               AND charge_type = 'Inland Carrier'), 0)
                                    END
                            ) AS land_charges

                            UNION ALL

                            -- Handling Fee
                            SELECT JSON_OBJECT(
                                'descripcion', 'Handling Fee',
                                'cantidad', cantidad_contenedores_40HQ + cantidad_contenedores_20FT, -- Suma de ambos tipos de contenedores
                                'costo_por_unidad', COALESCE(
                                    (SELECT MAX(handling_fee)
                                     FROM margins
                                     WHERE product_type = 'FCL'
                                       AND internal_notes LIKE CASE WHEN cantidad_contenedores_40HQ + cantidad_contenedores_20FT <= 5 THEN '%Hasta 5 contenedores%' ELSE '%Desde 6 contenedores%' END), 0),
                                'costo_total', COALESCE(
                                    (SELECT MAX(handling_fee)
                                     FROM margins
                                     WHERE product_type = 'FCL'
                                       AND internal_notes LIKE CASE WHEN cantidad_contenedores_40HQ + cantidad_contenedores_20FT <= 5 THEN '%Hasta 5 contenedores%' ELSE '%Desde 6 contenedores%' END), 0) * (cantidad_contenedores_40HQ + cantidad_contenedores_20FT)
                            ) AS handling_fee

                            UNION ALL

                            -- Documentation Fee
                            SELECT JSON_OBJECT(
                                'descripcion', 'Documentation Fee',
                                'cantidad', 1,
                                'costo_por_unidad', COALESCE(
                                    (SELECT MAX(documentation_fee)
                                     FROM margins
                                     WHERE product_type = 'FCL'), 0),
                                'costo_total', COALESCE(
                                    (SELECT MAX(documentation_fee)
                                     FROM margins
                                     WHERE product_type = 'FCL'), 0)
                            ) AS documentation_fee

                            UNION ALL

                            -- Total
                            SELECT JSON_OBJECT(
                                'descripcion', 'Total',
                                'cantidad', NULL,
                                'costo_por_unidad', NULL,
                                'costo_total',
                                    COALESCE((SELECT SUM(cost)
                                     FROM port_charges
                                     WHERE pod LIKE CONCAT('%', pod, '%')
                                       AND carrier LIKE CONCAT('%', carrier, '%')
                                       AND product_type = 'FCL'
                                       AND supplier_charge_name LIKE '%IMPO%'), 0) * cantidad_contenedores_40HQ
                                    +
                                    COALESCE((SELECT SUM(cost)
                                     FROM port_charges
                                     WHERE pod LIKE CONCAT('%', pod, '%')
                                       AND carrier LIKE CONCAT('%', carrier, '%')
                                       AND product_type = 'FCL'
                                       AND supplier_charge_name LIKE '%IMPO%'), 0) * cantidad_contenedores_20FT
                                    +
                                    CASE
                                        WHEN carrier IN ('Maersk', 'Hapag Lloyd', 'Cosco') THEN
                                            LEAST(
                                                COALESCE((SELECT MIN(cost)
                                                 FROM land_charges
                                                 WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                   AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                   AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                   AND product_type = 'FCL'
                                                   AND charge_type = 'Inland Carrier'), 0),
                                                COALESCE(
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                       AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Merchant'
                                                       AND trucker IS NULL), 0)
                                                + COALESCE(
                                                    (SELECT MIN(cost)
                                                     FROM land_charges
                                                     WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                                       AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                                       AND product_type = 'FCL'
                                                       AND charge_type = 'Inland Merchant'
                                                       AND trucker LIKE '%Amacavi%'), 0)
                                            )
                                        ELSE
                                            COALESCE((SELECT MIN(cost)
                                             FROM land_charges
                                             WHERE port_cfs_airport_name LIKE CONCAT('%', pod, '%')
                                               AND unlocation_id LIKE CONCAT('%', unlocation_id, '%')
                                               AND allowed_carriers LIKE CONCAT('%', carrier, '%')
                                               AND product_type = 'FCL'
                                               AND charge_type = 'Inland Carrier'), 0)
                                    END
                                    +
                                    COALESCE(
                                        (SELECT MAX(handling_fee)
                                         FROM margins
                                         WHERE product_type = 'FCL'
                                           AND internal_notes LIKE CASE WHEN cantidad_contenedores_40HQ + cantidad_contenedores_20FT <= 5 THEN '%Hasta 5 contenedores%' ELSE '%Desde 6 contenedores%' END), 0
                                    ) * (cantidad_contenedores_40HQ + cantidad_contenedores_20FT)
                                    +
                                    COALESCE(
                                        (SELECT MAX(documentation_fee)
                                         FROM margins
                                         WHERE product_type = 'FCL'), 0
                                    )
                            ) AS total_costs;
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
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "
                            Transforma ".json_encode($body). " en un query SQL
                            El siguiente SQL calcula el costo total por contenedor para FTL basándose en la ciudad de origen, la ciudad de destino y la cantidad de contenedores. Este cálculo se realiza utilizando solo los cargos terrestres (land_charges) correspondientes.
                            Responde solo la query sql para poder ejecutarla en otra funcion

                            -- Cotización FTL (Full Truck Load)
                            SELECT
                                'Total Costo FTL' AS descripcion,
                                1 AS cantidad, -- cantidad de FTL a cotizar (se puede cambiar según los datos)
                                COALESCE(
                                    (SELECT MIN(cost)
                                     FROM land_charges
                                     WHERE port_cfs_airport_name = 'Ciudad de Guatemala'
                                       AND unlocation_id = 'San José, Costa Rica'
                                       AND product_type = 'FTL'), 0) AS costo_por_unidad,

                                -- Cálculo del margen
                                COALESCE(
                                    (SELECT MIN(cost)
                                     FROM land_charges
                                     WHERE port_cfs_airport_name = 'Ciudad de Guatemala'
                                       AND unlocation_id = 'San José, Costa Rica'
                                       AND product_type = 'FTL'), 0) *
                                    (1 + (SELECT MAX(total_margin) / 100
                                          FROM margins
                                          WHERE product_type = 'FTL')) AS costo_con_margen -- Costo total con margen aplicado
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
