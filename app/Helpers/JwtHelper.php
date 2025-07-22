<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Date;

class JwtHelper
{
    private static $key = 'SECRET_KEY'; // ganti dengan key rahasia

    public static function encode($payload)
    {
        $payload['iat'] = time();
        $payload['exp'] = time() + (60 * 60); // 1 jam

        return JWT::encode($payload, self::$key, 'HS256');
    }

    public static function decode($jwt)
    {
        return JWT::decode($jwt, new Key(self::$key, 'HS256'));
    }
}
