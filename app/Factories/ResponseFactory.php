<?php


namespace App\Factories;


use Illuminate\Http\Response;

class ResponseFactory
{
    /**
     * Success Response
     *
     * @param string $message
     * @param null $data
     * @param int $statusCode
     * @param array $headers
     * @return Response
     */
    public static function success($message = '', $data = null, $statusCode = 200, $headers = [])
    {
        return new Response([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode, $headers);
    }

    /**
     * Error response
     *
     * @param string $message
     * @param null $data
     * @param int $statusCode
     * @param array $headers
     * @return Response
     */
    public static function error($message = 'Something went wrong', $data = null, $statusCode = 400, $headers = [])
    {
        return new Response([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $statusCode, $headers);
    }
}
