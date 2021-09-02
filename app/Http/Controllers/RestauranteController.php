<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RestauranteService;
use App\Traits\VerifyToken;
use App\Traits\Error;

class RestauranteController extends Controller
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
        $response = RestauranteService::index();
        $success = $response->json()['success'];
        if($success){
            $restaurantes = $response->json()['results'];
            return view(
                'home',
                compact('restaurantes')
            );
        }
        return $this->returnError($response, 'home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurante.cadastro');
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
        $response = RestauranteService::save($token, $request->nome);
        
        if($this->isTokenInvalid($response)){
            return redirect()->route('login');
        }
        
        $success = $response->json()['success'];
        if($success){
            return redirect()->route('restaurantes.index');
        }
        return $this->returnError($response);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = RestauranteService::getById($id);
        $success = $response->json()['success'];
        if($success){
            $restaurante = $response->json()['results'];
            return view(
                'restaurante.edicao',
                compact(['restaurante'])
            );
        }
        return $this->returnError($response);
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
        $token = session('token');
        $response = RestauranteService::update($token, $id, $request->nome);
        
        if($this->isTokenInvalid($response)){
            return redirect()->route('login');
        }

        $success = $response->json()['success'];
        if($success){
            return redirect()->route('restaurantes.index');
        }
        return $this->returnError($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurante = RestauranteService::getById($id);
        if(count($restaurante->json()['results']['cardapios']) > 0){
            return redirect()->back()->withErrors([
                'msg' => 'Há cardápios cadastrados neste restaurante. É necessário excluí-los!'
            ]);   
        }
        $token = session('token');
        $response = RestauranteService::delete($token, $id);
        
        if($this->isTokenInvalid($response)){
            return redirect()->route('login');
        }

        $success = $response->json()['success'];
        if($success){
            return redirect()->route('restaurantes.index');
        }
        return $this->returnError($response);
    }

}
