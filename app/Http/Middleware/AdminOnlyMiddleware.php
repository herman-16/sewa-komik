<?php

namespace App\Http\Middleware;

use Closure;

class AdminOnlyMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = $request->get('user');

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        return response('Forbidden - Admins only', 403);
    }
}
