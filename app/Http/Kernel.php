<?php

namespace Vest\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Vest\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Vest\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Vest\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Vest\Http\Middleware\RedirectIfAuthenticated::class,
        'is_admin' => \Vest\Http\Middleware\IsAdmin::class,
        'is_seller' => \Vest\Http\Middleware\IsSeller::class,
        //'is_company' => \Vest\Http\Middleware\IsCompany::class,
        'is_active' => \Vest\Http\Middleware\IsActive::class,
    ];
}
