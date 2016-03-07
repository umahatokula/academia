<?php

namespace App\Http;

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
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        // \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'login' => 'App\Http\Middleware\Login',
        'coder' => 'App\Http\Middleware\Admin',
        'principal' => 'App\Http\Middleware\Headmaster',
        'head_teacher' => 'App\Http\Middleware\HeadTeacher',
        'billing_officer' => 'App\Http\Middleware\BillingOfficer',
        'admin_dept_officer' => 'App\Http\Middleware\AdminDeptOfficer',
        'accounts_officer' => 'App\Http\Middleware\AccountOfficer',
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'sentry.auth' => \Sentinel\Middleware\SentryAuth::class,
        'sentry.admin' => \Sentinel\Middleware\SentryAdminAccess::class,
        'sentry.member' => \Sentinel\Middleware\SentryMember::class,
        'sentry.guest' => \Sentinel\Middleware\SentryGuest::class,
    ];
}
