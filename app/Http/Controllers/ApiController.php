<?php

namespace App\Http\Controllers;

use App\Models\Log as LogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller {
    public function save(Request $request) {
        $req = $request->all();

        try {
            $data = LogModel::create([
                'message' => 'Email saved',
                'context' => json_encode($req)
            ]);

            Log::info('Data saved', ['data' => $data]);

            return response()->json(['message' => 'data saved', 'data' => $data], 201);
        } catch (\Exception $e) {
            Log::error('Error saving email', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'error saving data'], 500);
        }
    }
}
