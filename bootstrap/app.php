<?php

use App\Http\Middleware\CekRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(function (Router $router) {
        require __DIR__ . '/../routes/web.php';
        require __DIR__ . '/../routes/console.php';

        $router->aliasMiddleware('role', CekRole::class);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\Illuminate\Session\Middleware\StartSession::class);
        $middleware->append(\Illuminate\View\Middleware\ShareErrorsFromSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
