<?php

use App\Http\Middleware\CheckAttendeeMiddleware;
use App\Http\Middleware\CheckOrganizerMiddleware;
use App\Http\Middleware\SocialiteRegisteration;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens([
            'webhook/stripe',
        ]);
        $middleware->alias([
            'socialite.registration' => SocialiteRegisteration::class,
            'attendee' => CheckAttendeeMiddleware::class,
            'organizer' => CheckOrganizerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        Integration::handles($exceptions);
    })->create();
