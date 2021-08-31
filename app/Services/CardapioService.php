<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class CardapioService 
{
    public static function index()
    {
        return Http::get(config("app.url_api") . 'cardapios');
    }

    public static function save($token, $request)
    {
        return Http::withToken($token)->post(config("app.url_api") . 'cardapios', [
            'descricao' =>  $request->descricao,
            'ativo' =>  $request->ativo,
            'restaurante_id' =>  $request->restaurante_id
        ]);
    }

    public static function getById($id)
    {
        return Http::get(config("app.url_api") . 'cardapios/' . $id);
    }

    public static function update($token, $id, $request)
    {
        return Http::withToken($token)->put(config("app.url_api") . 'cardapios/' . $id, [
            'descricao' =>  $request->descricao,
            'ativo' =>  $request->ativo,
            'restaurante_id' =>  $request->restaurante_id
        ]);
    }

    public static function delete($token, $id)
    {
        return Http::withToken($token)->delete(config("app.url_api") . 'cardapios/' . $id);
    }
}
