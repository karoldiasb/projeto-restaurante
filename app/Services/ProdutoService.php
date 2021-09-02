<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ProdutoService 
{
    public static function index()
    {
        return Http::get(config("app.url_api") . 'produtos');
    }

    public static function save($token, $request)
    {
        return Http::withToken($token)->post(config("app.url_api") . 'produtos', [
            'descricao' =>  $request->descricao,
            'cardapio_id' =>  $request->cardapio_id
        ]);
    }

    public static function getById($id)
    {
        return Http::get(config("app.url_api") . 'produtos/' . $id);
    }

    public static function update($token, $id, $request)
    {
        return Http::withToken($token)->put(config("app.url_api") . 'produtos/' . $id, [
            'descricao' =>  $request->descricao,
            'cardapio_id' =>  $request->cardapio_id
        ]);
    }

    public static function delete($token, $id)
    {
        return Http::withToken($token)->delete(config("app.url_api") . 'produtos/' . $id);
    }
}
