<?php

namespace App\Exceptions;

use App\Modules\EnumManager\Enums\GeneralEnum;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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


    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof ValidationException) {
                return $this->exceptionResponse(new UserException($exception->validator->getMessageBag()->first(), GeneralEnum::VALIDATION, Response::HTTP_UNPROCESSABLE_ENTITY));
            }

            if($exception instanceof AuthenticationException) {
                return $this->exceptionResponse(new UserException(null, GeneralEnum::UNAUTHORIZED, Response::HTTP_UNAUTHORIZED));
            }

            if($exception instanceof ModelNotFoundException) {
                return $this->exceptionResponse(new UserException(__('messages.resource_not_found'), GeneralEnum::NOT_FOUND, Response::HTTP_NOT_FOUND));
            }


            return $this->exceptionResponse($exception);
        }
        return parent::render($request, $exception);
    }
}
