<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__.'/../routes/web.php', commands: __DIR__.'/../routes/console.php', health: '/up')
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/admin/login');

        // Admin login: avoid 419 when the session cookie is not sent back (common on local Laragon).
        $middleware->validateCsrfTokens(except: [
            'admin/login',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (TokenMismatchException $e, $request) {
            if ($request->is('admin/login')) {
                return redirect()
                    ->to('/admin/login')
                    ->withErrors(['email' => 'Your session expired. Please sign in again.']);
            }

            if ($request->is('admin', 'admin/*')) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['_token' => 'Your session expired. Refresh the page and try saving again.']);
            }
        });
    })
    ->create();
