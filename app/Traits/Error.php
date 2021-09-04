<?php

namespace App\Traits;

trait Error
{
    public function returnError($response)
    {
        $msg = $response->message;
        $error_validator = $response->error_validator;
        
        if(is_object($error_validator)){
            $error_validator->msg = $msg;
        }else{
            $error_validator['msg']= $msg;
            $error_validator = (object)$error_validator;
        }
        
        return redirect()->back()->withErrors((object)$error_validator);   
    }
}