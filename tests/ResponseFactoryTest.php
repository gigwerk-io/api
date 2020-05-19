<?php


namespace Tests;


class ResponseFactoryTest
{
    /**
     * Success Response
     *
     * @param string $message
     * @param null $data
     * @return array
     */
    public static function success($message = '', $data = null)
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
    }

    /**
     * Error response
     *
     * @param string $message
     * @param null $data
     * @return array
     */
    public static function error($message = 'Something went wrong', $data = null)
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => $data
        ];
    }
}
