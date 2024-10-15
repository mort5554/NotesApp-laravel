<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Log;
use Str;

#[Layout('layouts.layout')]
#[Title('Logowanie')]
class LoginForm extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        // Walidacja danych wejściowych
        $this->validate();

        // Próba zalogowania użytkownika
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();

            // Logowanie globalnego tokenu (sprawdzenie, czy istnieje)
            $globalToken = Cache::get('global_session_token');
            if (!$globalToken) {
                $globalToken = Str::random(32);  // Generowanie nowego tokenu
                Cache::put('global_session_token', $globalToken);  // Przechowywanie w cache
            }

            // Generowanie unikalnego tokenu dla sesji użytkownika
            //$userToken = Str::random(32);
            session(['user_token' => $globalToken]);

            // Zapisanie tokenu użytkownika w cache z kluczem user_session_token_{id}
            Cache::put('user_session_token_' . $user->id, $globalToken, now()->addDay());

            // Logowanie dla debugowania
            Log::info('Zalogowano użytkownika', [
                'user_id' => $user->id,
                'user_token' => $globalToken,
                'cached_user_token' => Cache::get('user_session_token_' . $user->id)
            ]);

            return redirect()->intended('/note');
        }

        $this->addError('password', 'Nieprawidłowy email lub hasło.');
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
