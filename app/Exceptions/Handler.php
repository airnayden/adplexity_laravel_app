<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, \Throwable $exception): \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
    {
        if ($request->is('api/*')) {
            return $this->handleApiException($request, $exception);
        } else {
            return parent::render($request, $exception);
        }
    }

    /**
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleApiException($request, \Throwable $exception): JsonResponse
    {
        // Override API 404 for Models
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => trans('adplexity.error_not_found')
            ], 404);
        }

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $statusCode = 422;
        }

        if ($exception instanceof \HttpResponseException) {
            $exception = $exception->getResponse();
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = trans('adplexity.http_error_unahuthorized');
                break;
            case 403:
                $response['message'] = trans('adplexity.http_error_forbidden');
                break;
            case 404:
                $response['message'] = trans('adplexity.http_error_not_found');
                break;
            case 405:
                $response['message'] = trans('adplexity.http_error_method_not_allowed');
                break;
            case 422:
                $response['message'] = trans('adplexity.http_error_validation');

                /**
                 * @var ValidationException $exception
                 */
                $response['errors'] = $exception->errors();
                break;
            default:
                $response['message'] = ($statusCode == 500) ? trans('adplexity.http_error_general') : $exception->getMessage();
                break;
        }

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}
