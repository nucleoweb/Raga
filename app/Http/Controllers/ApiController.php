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
            $config = Config::first();
            $prompt = $config ? $config->departure_prompt : '';

            $today = date('Y-m-d');
            $dateExpire = date('Y-m-d', strtotime($today . ' + 7 days'));

            $prompt = str_replace('$body', $body, $prompt);
            $prompt = str_replace('$query', $query, $prompt);
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
