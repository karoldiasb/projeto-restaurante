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
        $user_id = session('user_id');
        $response = RestauranteService::index($user_id );

        if($response->successful()){
            $restaurantes = $response->object()->results;
            return view('home', compact('restaurantes'));
        }

        return $this->returnError($response->object());
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
        $user_id = session('user_id');
        $response = RestauranteService::save($token, $request, $user_id);
        
        if($this->isTokenInvalid($response)){
            $msg = "Sessão expirada. Por favor, faça o login novamente";
            return view('auth.login', compact('msg'));
        }
        if($response->successful()){
            return redirect()->route('restaurantes.index');
        }
        return $this->returnError($response->object());
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
        if($response->successful()){
            $restaurante = $response->object()->results;
            return view(
                'restaurante.edicao',
                compact(['restaurante'])
            );
        }
        return $this->returnError($response->object());
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
        $response = RestauranteService::update($token, $id, $request);
        
        if($this->isTokenInvalid($response)){
            $msg = "Sessão expirada. Por favor, faça o login novamente";
            return view('auth.login', compact('msg'));
        }

        if($response->successful()){
            return redirect()->route('restaurantes.index');
        }
        return $this->returnError($response->object());
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
        if(count($restaurante->object()->results->cardapios) > 0){
            return redirect()->back()->withErrors([
                'msg' => 'Há cardápios cadastrados neste restaurante. 
                Para que seja possível excluir o restaurante, é necessário excluí-los!'
            ]);   
        }
        
        $token = session('token');
        $response = RestauranteService::delete($token, $id);
        
        if($this->isTokenInvalid($response)){
            $msg = "Sessão expirada. Por favor, faça o login novamente";
            return view('auth.login', compact('msg'));
        }

        if($response->successful()){
            return redirect()->route('restaurantes.index');
        }
        return $this->returnError($response->object());
    }

}
