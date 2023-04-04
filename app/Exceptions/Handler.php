<?php

namespace App\Exceptions;

use App\Traits\HttpResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Psr\Log\LogLevel;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponse;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        InvalidArgumentException::class => LogLevel::ERROR,
        ModelNotFoundException::class => LogLevel::EMERGENCY
    ];

    private const EXCEPTIONS_HTTP_CODE = [
        ValidationException::class=>Response::HTTP_BAD_REQUEST,
        AuthorizationException::class=>Response::HTTP_UNAUTHORIZED
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $throwable)
    {
        $context = [];
        $errors = [];
        
       
        $statusCode = $this::EXCEPTIONS_HTTP_CODE[$throwable::class] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
		if ($request) {
			$context = $request->all();
		}
        if ($throwable instanceof ValidationException) { // Em caso de Exceção por usuário não autenticado.
			$errors = $throwable->errors();
		}
        return $this->sendResponse($statusCode,$errors);
    }
}
