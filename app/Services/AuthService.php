<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class AuthService 
{
    public static function login($request)
    {
        return Http::post(config("app.url_api") . 'auth/login/', [
            'email' => $request->email,
            'password' => $request->password
        ]);
    }

    public static function logout()
    {
        return Http::get(config("app.url_api") . 'auth/logout/');
    }
}
