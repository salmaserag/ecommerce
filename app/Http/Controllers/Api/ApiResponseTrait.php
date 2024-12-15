<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiResponse($success = null , $message = null , $data = null , $status = null)
    {
         $array = [
            'success'=>$success,
            'message'=>$message,
            'data'=>$data,
         ];

         return response($array , $status);

    }
}