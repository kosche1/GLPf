<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // ... other middleware ...
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Web middleware group
        ],

        'api' => [
            // API middleware group
        ],
    ];

    /**
     * The application's route middleware aliases.
     *
     * Aliases may be used instead of class names to assign middleware to routes.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        // ... other middleware aliases ...
        'role' => \App\Http\Middleware\CheckRole::class,
        // 'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        // 'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ];
} 