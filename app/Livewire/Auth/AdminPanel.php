<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use Str;

#[Layout('layouts.layout')]
#[Title('Admin Panel')]
class AdminPanel extends Component
{
    use WithPagination;

    public $search;

    public function logoutAllUsers(){

        // Generowanie nowego globalnego tokenu sesji
        $newGlobalToken = \Str::random(32);

        // Zapisanie nowego tokenu do cache
        Cache::put('global_session_token', $newGlobalToken);

        // Pobranie wszystkich użytkowników oprócz administratorów
        $users = User::where('role', '!=', 'admin')->get();

        // Wylogowanie tylko tych użytkowników, którzy nie są administratorami
        foreach ($users as $user) {
            Cache::forget('user_session_' . $user->id);
        }

        session()->flash('message', 'Wszyscy użytkownicy zostali wylogowani oprócz administratorów');
    }


    public function logoutUser($id)
    {
        $user = User::find($id);
        if ($user) {
            // Generowanie nowego tokenu dla użytkownika
            $newUserToken = Str::random(32);

            // Zaktualizowanie tokenu w cache dla danego użytkownika (wylogowanie użytkownika)
            Cache::put('user_session_token_' . $id, $newUserToken);

            session()->flash('message', 'Użytkownik o ID ' . $id . ' został wylogowany.');
        } else {
            session()->flash('error', 'Użytkownik nie został znaleziony.');
        }
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('livewire.auth.admin-panel', ['users' => $users]);
    }
}
