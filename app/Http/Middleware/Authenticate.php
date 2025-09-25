<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Aggiungi un messaggio di errore in sessione
            session()->flash('auth_error', 'Devi prima effettuare l\'accesso.');

            return route('loginPage');
        }

        return null;
    }
}
