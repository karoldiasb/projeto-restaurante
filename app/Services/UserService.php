<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class UserService 
{

    public static function save($request)
    {
        return Http::post(config("app.url_api") . 'registrar', [
            'name' =>  $request->nome,
            'email' =>  $request->email,
            'password' => $request->password
        ]);
    }

    
}
