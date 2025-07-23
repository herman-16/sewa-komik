<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class BasicAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();

        if ($username && $password) {
            // Ganti jadi cek berdasarkan email (karena tidak ada kolom username)
            $user = DB::table('users')->where('email', $username)->first();

            if ($user && password_verify($password, $user->password)) {
                // Simpan user ke request
                $request->attributes->add(['user' => $user]);
                return $next($request);
            }
        }

        return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
