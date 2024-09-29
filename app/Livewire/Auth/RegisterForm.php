<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed|',
    ];

    public function register()
    {
        // Walidacja formularza
        $validatedData = $this->validate();

        // Tworzenie nowego użytkownika
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Wywołanie zdarzenia rejestracji (do weryfikacji e-mail)
        event(new Registered($user));

        // Automatyczne logowanie nowego użytkownika
        Auth::login($user);

        // Przekierowanie do strony weryfikacji e-mail
        return redirect()->route('verification.notice');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
