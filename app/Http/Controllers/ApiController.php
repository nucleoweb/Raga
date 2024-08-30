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
			
			try  {
				$response = $this->processInformationByAi($body);
				$query = $this->getTransportRates($response);
				
				$data = LogModel::create([
					'message' => 'Email saved',
					'context' => json_encode($req),
					'response' => $response,
				]);
				
				Log::info('Data saved', ['data' => $data]);
				
				//$queryData = json_decode($query->getContent(), true);
				
				//$dataArray = $queryData['data'];
				$pptoResponse = $this->processQueryData($query);
				
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
			
			$result = OpenAI::chat()->create([
				'model' => 'gpt-4o-mini',
				'messages' => [
					[
						'role' => 'user',
						'content' =>
							"Toma este requerimiento: $body .
				Eres un experto en bases de datos SQL con habilidades avanzadas en manejo de datos incompletos o mal escritos. Necesito que generes una consulta SQL para obtener los costos de transporte, incluyendo tanto los costos en el puerto como los costos en tierra, utilizando las tablas `PortCharges` y `LandCharges` en una base de datos MySQL.
				Las tablas tienen los siguientes campos:
				
				Te dejo una query de ejemplo y reeplaza el puerto de destino, la ciudad de origen y el carrier con los datos que vienen en el correo
				
				SELECT
				    product_type,
				    service_type,
				    origin_country AS location,
				    pol AS port_or_location,
				    carrier,
				    supplier,
				    supplier_charge_name,
				    internal_charge_name,
				    cost,
				    currency,
				    goodstype,
				    publish_date,
				    effective_date,
				    expire_date,
				    sell_rate,
				    internal_notes,
				    external_notes,
				    pricing_notes
				FROM
				    port_charges
				WHERE
				    pod LIKE '%Limón%'
				    AND carrier LIKE '%evergreen%'
				
				UNION
				
				SELECT
				    product_type,
				    service_type,
				    country_name AS location,
				    unlocation_id AS port_or_location,
				    NULL AS carrier,
				    supplier,
				    supplier_charge_name,
				    internal_charge_name,
				    cost,
				    currency,
				    goodstype,
				    publish_date,
				    effective_date,
				    expire_date,
				    sell_rate,
				    internal_notes,
				    external_notes,
				    pricing_notes
				FROM
				    land_charges
				WHERE
				    unlocation_id LIKE '%alajuela%'
				    AND allowed_carriers LIKE '%evergreen%';
				
				No incluyas las fechas ejemplo     AND effective_date <= CURDATE()  AND (expire_date IS NULL OR expire_date >= CURDATE())
				Es posible que los nombres de los puertos (`pol`, `pod`) y las ciudades (`port_cfs_airport_name`) no estén escritos correctamente o que se utilicen abreviaciones o variantes. Por favor, trata de deducir el nombre correcto del puerto o la ciudad utilizando la información disponible, como el país de origen, el país de destino y otras pistas contextuales.
				Genera una consulta SQL que combine las tablas `PortCharges` y `LandCharges` para calcular el costo total del transporte de un producto específico (`product_type`) desde un puerto de carga (`pol`) hasta una ubicación terrestre específica (`port_cfs_airport_name`). La consulta debe considerar cualquier regla de cálculo, corregir posibles errores en los nombres de puertos y ciudades, y filtrar por fechas vigentes (entre `effective_date` y `expire_date`). La consulta debe retornar el costo total en la moneda especificada (`currency`) y estar optimizada para ejecutar de manera eficiente.
				Solo devuelve la consulta sql.",
					],
				],
			]);
			
			Log::info('response saved', ['data' => $result->choices[0]->message->content]);
			return $result->choices[0]->message->content;
		}
		
		public function processQueryData($body) {
			Log::error('response before', ['data' => $body]);
			
			$result = OpenAI::chat()->create([
				'model' => 'gpt-4o-mini',
				'messages' => [
					[
						'role' => 'user',
						'content' =>
							"En el siguiente array $body  suma los costos y prepara una respuesta con estos datos para una cotización de transporte",
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
