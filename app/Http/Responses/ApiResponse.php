<?php
namespace App\Http\Responses;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $code = 200)
    {
        return new JsonResponse([
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error($message = 'Error', $code = 400, $errors = [])
    {
        return new JsonResponse([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
