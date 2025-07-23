<?php

namespace App\Http\Middleware;

use Closure;

class UserOnlyMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = $request->get('user');

        if ($user && $user->role === 'user') {
            return $next($request);
        }

        return response('Forbidden - Users only', 403);
    }
}
