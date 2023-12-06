<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function returnResponse($statusCode, $message, $data = [])
    {
        $response = [
            'message' => $message,
            'data' => $data,
        ];

        return new JsonResponse($response, $statusCode);
    }
}

