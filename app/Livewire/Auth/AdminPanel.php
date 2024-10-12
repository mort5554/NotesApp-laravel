<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.layout')]
#[Title('Admin Panel')]
class AdminPanel extends Component
{
    public function render()
    {
        return view('livewire.auth.admin-panel');
    }
}
