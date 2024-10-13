<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Livewire\WithoutUrlPagination;

#[Layout('layouts.layout')]
#[Title('Admin Panel')]
class AdminPanel extends Component
{
    use WithoutUrlPagination;

    public $search;

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
