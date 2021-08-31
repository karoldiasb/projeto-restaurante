<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RestauranteService;
use App\Services\CardapioService;
use App\Traits\VerifyToken;
use App\Traits\Error;

class CardapioController extends Controller
{
    use VerifyToken;
    use Error;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = RestauranteService::index();
        $data = $response->json()['results'];
        return view(
            'cardapio.cadastro',
            compact('data')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = session('token');
        $response = CardapioService::save($token, $request);
        
        if($this->isTokenInvalid($response)){
            return redirect()->route('login');
        }
        
        $success = $response->json()['success'];
        if($success){
            return redirect()->route('restaurantes.index');
        }
        $response_restaurante = RestauranteService::index();
        $restaurantes = $response_restaurante->json()['results'];
        return $this->returnError($response, 'cardapio.cadastro', $restaurantes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
