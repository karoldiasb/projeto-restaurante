<?php

namespace App\Traits;

trait VerifyToken
{
    public function isTokenInvalid($response)
    {
        if(isset($response->object()->status)){
            session([
                'token' => "", 
                "user_id" => ""
            ]);
            return TRUE;
        }
        return FALSE;
    }
}