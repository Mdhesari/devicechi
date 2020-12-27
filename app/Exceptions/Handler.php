<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $e)
    {

        if ($e instanceof MFSValidationException) {

            $errors = $e->getErrors();

            if ($request->expectsJson())
                return response()->json([
                    'errors' => $errors,
                ]);


            return back()->with($errors);
        }

        if ($e instanceof PreviousStepRedirectHttpException) {

            $url = $e->getUrl();

            return redirect($url);
        }

        return parent::render($request, $e);
    }
}
