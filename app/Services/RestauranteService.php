<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class RestauranteService 
{
    public static function index()
    {
        return Http::get(config("app.url_api") . 'restaurantes');
    }

    public static function save($token, $nome)
    {
        return Http::withToken($token)->post(config("app.url_api") . 'restaurantes', [
            'nome' =>  $nome
        ]);
    }

    public static function getById($id)
    {
        return Http::get(config("app.url_api") . 'restaurantes' . $id);
    }
}
