<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
            // Jeśli logowanie powiodło się, przekieruj na stronę domową (lub inną)
            return redirect()->intended('/note');
        }

        // Jeśli logowanie się nie powiodło, wyświetl komunikat o błędzie
        $this->addError('password', 'Nieprawidłowy email lub hasło.');
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
