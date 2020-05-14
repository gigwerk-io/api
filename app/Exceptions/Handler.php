<?php

namespace App\Exceptions;

use App\Factories\ResponseFactory;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $render =  parent::render($request, $exception);

        if($request->expectsJson()){
            $message = $exception->getMessage();

            if($exception instanceof ValidationException){
                $message = array_values($exception->errors());
            }

            if($exception instanceof NotFoundHttpException){
                $message = 'Route does not exist.';
            }

            if($exception instanceof MethodNotAllowedHttpException){
                $message = sprintf('The request method %s is not allowed.', $request->method());
            }

            return ResponseFactory::error($message, null, $render->getStatusCode());
        }

        return $render;
    }
}
