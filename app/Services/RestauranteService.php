<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class RestauranteService 
{
    public static function index($user_id = null)
    {
        return Http::get(config("app.url_api") . 'restaurantes', [
            'user_id' => $user_id
        ]);
    }

    public static function save($token, $request, $user_id)
    {
        return Http::withToken($token)->post(config("app.url_api") . 'restaurantes', [
            'nome' =>  $request->nome,
            'user_id' => $user_id
        ]);
    }

    public static function getById($id)
    {
        return Http::get(config("app.url_api") . 'restaurantes/' . $id);
    }

    public static function update($token, $id, $request)
    {
        return Http::withToken($token)->put(config("app.url_api") . 'restaurantes/' . $id, [
            'nome' =>  $request->nome
        ]);
    }

    public static function delete($token, $id)
    {
        return Http::withToken($token)->delete(config("app.url_api") . 'restaurantes/' . $id);
    }
}
