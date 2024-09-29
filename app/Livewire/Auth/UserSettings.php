<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSettings extends Component
{
    public $name;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        // Pobranie zalogowanego użytkownika
        $user = Auth::user();
        $this->name = $user->name;
    }

    public function changeName()
    {
        $this->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->save();

        session()->flash('message', 'Nazwa została pomyślnie zmieniona!');
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',  // "confirmed" sprawdza poprawność powtórzenia hasła
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            session()->flash('error', 'Aktualne hasło jest nieprawidłowe.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'Hasło zostało zmienione pomyślnie.');
        $this->reset(['current_password', 'new_password', '$new_password_confirmation']);
    }

    public function render()
    {
        $user = Auth::user();
        $noteCount = $user->notes()->count();

        return view('livewire.auth.user-settings', [
            'user' => $user, 'noteCount' => $noteCount
        ])
            ->layout('noteLayout');
    }
}
