<?php

namespace App\Traits;

trait VerifyToken
{
    public function isTokenInvalid($response)
    {
        if(isset($response->json()['status'])){
            session(['token' => ""]);
            return TRUE;
        }
        return FALSE;
    }
}