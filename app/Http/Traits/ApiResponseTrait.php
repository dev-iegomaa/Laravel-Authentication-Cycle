<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    private function apiResponse($status = 200, $message = null, $errors = null, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message
        ];

        if (is_null($errors) && !is_null($data))
            $response['data'] = $data;
        else
            $response['errors'] = $errors;

        return response($response, 200);
    }
}
