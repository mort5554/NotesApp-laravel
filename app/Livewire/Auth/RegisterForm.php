<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Str;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed',
    ];

    public function register()
    {
        // Walidacja formularza
        $this->validate();

        // Tworzenie nowego użytkownika
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Automatyczne zalogowanie nowego użytkownika
        Auth::login($user);

        // Sprawdzanie, czy globalny token istnieje w cache, jeśli nie, wygeneruj nowy
        $globalToken = Cache::get('global_session_token');
        if (!$globalToken) {
            // Generowanie nowego tokenu globalnego
            $globalToken = Str::random(32);
            Cache::put('global_session_token', $globalToken);  // Przechowywanie w cache
        }

        // Przypisanie nowego tokenu sesji dla zalogowanego użytkownika
        $userToken = Str::random(32);  // Generowanie unikalnego tokenu dla sesji
        session(['user_token' => $userToken]);

        // Zapisanie unikalnego tokenu użytkownika w cache
        Cache::put('user_session_token_' . $user->id, $userToken, now()->addDay());

        return redirect()->route('verification.notice');  // Przekierowanie po rejestracji
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}

