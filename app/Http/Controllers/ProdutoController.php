<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CardapioService;
use App\Services\ProdutoService;
use App\Traits\VerifyToken;
use App\Traits\Error;

class ProdutoController extends Controller
{
    use VerifyToken;
    use Error;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = session('user_id');
        $response = CardapioService::index($user_id);
        $data = $response->object()->results;

        return view('produto.cadastro', compact('data'));
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
        $response = ProdutoService::save($token, $request);
        
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
        $response = ProdutoService::getById($id);
        $user_id = session('user_id');
        $responseService = CardapioService::index($user_id);
        $data = $responseService->object()->results;

        if($response->successful()){
            $produto = $response->object()->results;
            return view('produto.edicao', compact(['produto','data']));
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
        $response = ProdutoService::update($token, $id, $request);
        
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
        $token = session('token');
        $response = ProdutoService::delete($token, $id);
        
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
