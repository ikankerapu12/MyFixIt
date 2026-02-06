<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'role' => App\Http\Middleware\Role::class,
        'redirect.role' => App\Http\Middleware\RedirectByRole::class,
    ]);
    
    })
    ->withExceptions(function ($exceptions) {

$exceptions->render(function (NotFoundHttpException $e, $request) {

        $dashboardUrl = route('login');

        $user = $request->user(); // ✅ IMPORTANT

        if ($user) {
            if ($user->role === 'admin') {
                $dashboardUrl = route('admin.dashboard');
            } elseif ($user->role === 'technician') {
                $dashboardUrl = route('technician.dashboard');
            } elseif ($user->role === 'user') {
                $dashboardUrl = route('dashboard');
            }
        }

        return response()->view('errors.404', compact('dashboardUrl'), 404);
    });
    })->create();
