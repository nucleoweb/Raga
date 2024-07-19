<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/prueba', function (Request $request) {
    Log::info('prueba');
    return response()->json(['message' => 'Hola mundo']);
});

Route::post('/email', [App\Http\Controllers\ApiController::class, 'save']);
