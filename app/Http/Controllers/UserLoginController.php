<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserLoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Walidacja podstawowa (email i hasło)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Sprawdzenie, czy użytkownik o podanym e-mailu istnieje
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Jeśli użytkownik o podanym e-mailu nie istnieje, zwróć błąd
            return back()->withErrors([
                'email' => 'Użytkownik o podanym adresie email nie istnieje.',
            ])->withInput();
        }

        // Próba zalogowania użytkownika
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jeśli logowanie powiodło się, przekieruj na stronę domową (lub inną)
            return redirect()->intended('dashboard'); // lub inna ścieżka np. '/note'
        }

        // Jeśli logowanie się nie powiodło, zwróć odpowiedni błąd
        return back()->withErrors([
            'password' => 'Nieprawidłowe hasło.',
        ])->withInput();
    }
}
