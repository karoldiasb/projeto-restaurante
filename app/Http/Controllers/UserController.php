<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\Error;

class UserController extends Controller
{
    use Error;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registro');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        $response = UserService::save($request);

        $success = $response->json()['success'];
        if($success){
            return redirect()->route('login');
        }
        return $this->returnError($response, 'auth.registro');
   }
}
