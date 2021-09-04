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
        $data = $response->json()['results'];
        return view(
            'produto.cadastro',
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
        $response = ProdutoService::save($token, $request);
        
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
        $response = ProdutoService::getById($id);
        $responseService = CardapioService::index();
        $data = $responseService->json()['results'];
        $success = $response->json()['success'];
        if($success){
            $produto = $response->json()['results'];
            return view(
                'produto.edicao',
                compact(['produto','data'])
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
        $response = ProdutoService::update($token, $id, $request);
        
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
        $token = session('token');
        $response = ProdutoService::delete($token, $id);
        
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
