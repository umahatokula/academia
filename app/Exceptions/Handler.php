<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use GrahamCampbell\Exceptions\ExceptionHandler as GrahamExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use declaration;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends GrahamExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if ($e instanceof TokenMismatchException) {
            return redirect($request->fullurl())->with('csrf_error', 'Taking too Long, please refresh the page and try again');
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return redirect($request->fullurl())->with('csrf_error', 'Taking too Long, please refresh the page and try again');
        }


        return parent::render($request, $e);
    }
}
