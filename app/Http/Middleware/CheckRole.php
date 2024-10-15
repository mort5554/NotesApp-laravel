<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sprawdź, czy użytkownik jest zalogowany
        if (Auth::check()) {
            $user = Auth::user();

            // Jeśli użytkownik jest adminem i nie jest już na stronie admina, przekieruj do panelu admina
            if ($user->role == 'admin' && !$request->is('admin')) {
                return redirect()->route('admin');
            }

            // Jeśli użytkownik ma rolę "user" i nie jest na stronie notatek, przekieruj do listy notatek
            if ($user->role == 'user' && !$request->is('note') && !$request->is('note/*')) {
                return redirect()->route('note.index');
            }
        }

        // Jeśli nie jest zalogowany lub nie ma określonej roli, kontynuuj normalne przetwarzanie
        return $next($request);
    }
}
