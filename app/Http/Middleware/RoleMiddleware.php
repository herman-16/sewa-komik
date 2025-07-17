<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $role)
    {
        $userId = $request->header('X-User-ID'); // asumsi header membawa ID user
        if (!$userId) {
            return response()->json(['message' => 'User ID is missing from headers'], 401);
        }

        $user = User::find($userId);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        if ($user->role !== $role) {
            return response()->json(['message' => 'Access denied: Only ' . $role . ' can access this route'], 403);
        }

        return $next($request);
    }
}
