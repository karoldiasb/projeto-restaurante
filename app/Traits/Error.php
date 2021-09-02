<?php

namespace App\Traits;

trait Error
{
    public function returnError($response)
    {
        $msg = $response->json()['message'];
        $error_validator = $response->json()['error_validator'];
        $error_validator['msg'] = $msg;
        return redirect()->back()->withErrors($error_validator);   
    }
}