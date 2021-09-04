<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $response = AuthService::login($request);
        
        if($response->successful()){
            session([
                'token' => $response->json()['access_token'],
                'user_id' => $response->json()['user_id']
            ]);
            return redirect()->route('restaurantes.index');
        }
        $error = $response->object()->message;
        return view(
            'auth.login',
            compact('error')
        );
    }

    public function logout()
    {
        $response = AuthService::logout();

        if($response->successful()){
            session(['token' => ""]);
            session(['user_id' => ""]);
        }
        return redirect()->route('restaurantes.index');
    }
}
