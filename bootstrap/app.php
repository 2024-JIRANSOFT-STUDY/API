<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api',
        web: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // AuthenticationException 처리
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            Log::debug($request->ip());
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        });
        // NotFoundHttpException 처리
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
            Log::debug($request->ip());
            return response()->view('error', [], 404);
        });

        // MethodNotAllowedHttpException 처리
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Method not allowed.'
            ], 405);
        });

        // ValidationException 처리
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        });

        // ModelNotFoundException 처리
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'message' => 'Model not found.'
            ], 404);
        });

        // RouteNotFoundException 처리
        $exceptions->render(function (RouteNotFoundException $e, Request $request) {
            return response()->json([
                'message' => 'Route not found.'
            ], 404);
        });

        // QueryException 처리
        $exceptions->render(function (QueryException $e, Request $request) {
            $response = [
                'message' => 'Database query error',
            ];
            if (!app()->environment('production')) {
                $response['details'] = $e->getMessage();
            }
            return response()->json($response, 500);
        });
    })->create();
