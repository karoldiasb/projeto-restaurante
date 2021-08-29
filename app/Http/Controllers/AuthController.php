<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $response = Http::post('http://localhost:8081/api/auth/login/', [
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        if($response->json()['success']){
            session(['token' => $response->json()['access_token']]);
            return redirect()->route('restaurantes.index');
        }

        $error = $response->json()['error'];
        return view(
            'auth.login',
            compact('error')
        );
    }

    public function logout()
    {
        $response = Http::get('http://localhost:8081/api/auth/logout/');
        if($response->json()['success']){
            session(['token' => ""]);
        }
        return redirect()->route('restaurantes.index');
    }
}
