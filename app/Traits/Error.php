<?php

namespace App\Traits;

trait Error
{
    public function returnError($response, $view, $data = null)
    {
        $msg = $response->json()['message'];
        $error_validator = $response->json()['error_validator'];
        return view(
            $view,
            compact(['msg', 'error_validator', 'data'])
        );
    }
}