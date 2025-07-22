<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use Closure;
use Exception;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $payload = JwtHelper::decode($token);
            $request->auth = $payload;
        } catch (Exception $e) {
            return response()->json(['error' => 'Token Invalid'], 401);
        }

        return $next($request);
    }
}
