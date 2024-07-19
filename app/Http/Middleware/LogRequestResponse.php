<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequestResponse {
    public function handle(Request $request, Closure $next): Response {
        $data = $request->all();

        if ($request->isMethod('post') && $request->path() === 'api/auth/login' && isset($data['password'])) {
            $data['password'] = 'REDACTED';  // Mask the password
        }

        Log::info("API Request: {$request->method()}, {$request->fullUrl()}", [
            'headers' => $request->headers->all(),
            'body' => $data,
        ]);

        $response = $next($request);

        Log::info("API Response: {$response->status()}, {$request->fullUrl()}", [
            'headers' => $response->headers->all(),
            'body' => $response->getContent(),
        ]);

        return $response;
    }
}
