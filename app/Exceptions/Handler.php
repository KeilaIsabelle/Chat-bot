<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    // ... outros métodos e propriedades ...

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
                ? $exception->getStatusCode()
                : 400);
        }

        return parent::render($request, $exception);
    }
}
?>