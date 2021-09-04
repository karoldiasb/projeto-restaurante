<?php

namespace App\Traits;

trait Error
{
    public function returnError($response)
    {
        $msg = $response->message;
        $errors = $response->errors;
        
        if(is_object($errors)){
            $errors->msg = $msg;
        }else{
            $errors['msg']= $msg;
            $errors = (object)$errors;
        }
        
        return redirect()->back()->withErrors((object)$errors);   
    }
}