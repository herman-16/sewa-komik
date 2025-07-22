<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\JwtHelper;

class AuthController extends Controller
{
    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => app('hash')->make($request->password),
        ]);

        return response()->json(['message' => 'Registrasi berhasil'], 201);
    }

    
    public function login(Request $request) {
        $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required'
        ]);
        
    $user = User::where('email', $request->email)->first();

    if (!$user || !app('hash')->check($request->password, $user->password)) {
        return response()->json(['message' => 'Login gagal'], 401);
    }

    //Buat token JWT
    $token = JwtHelper::encode([
        'user_id' => $user->id,
        'role' => $user->role
    ]);

    return response()->json([
        'message' => 'Login berhasil',
        'user' => $user,
        'token' => $token
    ]);
}
}
