<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Log;

class CheckUserSession
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Pomijamy administratorów
            if ($user->role === 'admin') {
                return $next($request);
            }

            // Pobranie globalnego tokenu sesji z cache
            $globalSessionToken = Cache::get('global_session_token');

            // Pobranie tokenu użytkownika z sesji i cache
            $userToken = $request->session()->get('user_token');
            $cachedUserToken = Cache::get('user_session_token_' . $user->id);

            // Logowanie danych dla debugowania
            Log::info('Sprawdzanie sesji użytkownika', [
                'user_id' => $user->id,
                'user_token' => $userToken,
                'cached_user_token' => $cachedUserToken,
                'global_session_token' => $globalSessionToken,
            ]);

            // Jeśli brak tokenu w sesji lub cache, nie wylogowuj od razu
            if (empty($userToken) || empty($cachedUserToken)) {
                Log::info('Token użytkownika nie jest ustawiony, pomijam wylogowanie');
                return $next($request);
            }

            // Sprawdzenie, czy token użytkownika jest zgodny z globalnym tokenem i tokenem z cache
            if ($userToken !== $globalSessionToken || $userToken !== $cachedUserToken) {
                Auth::logout();  // Wylogowanie użytkownika
                $request->session()->invalidate();  // Unieważnienie sesji
                $request->session()->regenerateToken();  // Regeneracja CSRF tokenu

                return redirect()->route('login')->with('message', 'Zostałeś wylogowany przez administratora.');
            }
        }

        return $next($request);
    }
}

