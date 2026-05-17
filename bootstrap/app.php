<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register custom middleware aliases (Unit III)
        $middleware->alias([
            'role'  => \App\Http\Middleware\RoleMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// ── Vercel Serverless Overrides ──
// Vercel's filesystem is read-only except /tmp
// Redirect all writable paths to /tmp so Laravel doesn't crash
$isVercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) 
    || is_dir('/tmp/bootstrap-cache/cache');

if ($isVercel) {
    $app->useStoragePath('/tmp/storage');
    $app->useBootstrapPath('/tmp/bootstrap-cache');
}

return $app;
