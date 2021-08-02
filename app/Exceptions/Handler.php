<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Models\GlobalSetting;

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
        $this->renderable(function (HttpException $e, $request) {
            $globalSetting = GlobalSetting::first();
            $statusCode = $e->getStatusCode();

            if($statusCode == 403){
                return response()->view('errors.403', [
                    'color' => $globalSetting->primary_color
                ], 403);
            }else if($statusCode == 404){
                return response()->view('errors.404', [
                    'color' => $globalSetting->primary_color
                ], 404);
            }
        });
    }
    
}
