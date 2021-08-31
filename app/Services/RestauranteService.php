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
        return Http::get(config("app.url_api") . 'restaurantes/' . $id);
    }

    public static function update($token, $id, $nome)
    {
        return Http::withToken($token)->put(config("app.url_api") . 'restaurantes/' . $id, [
            'nome' =>  $nome
        ]);
    }

    public static function delete($token, $id)
    {
        return Http::withToken($token)->delete(config("app.url_api") . 'restaurantes/' . $id);
    }
}
