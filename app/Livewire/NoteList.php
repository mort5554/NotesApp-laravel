<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Note;

class NoteList extends Component
{
    use WithPagination;

    public function render()
    {
        // Pobieranie notatek w metodzie render
        $notes = Note::query()
            ->where('user_id', request()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        // Zwracanie widoku Livewire z notatkami
        return view('livewire.note.note-list', ['notes' => $notes])
            ->layout('layouts.noteLayout');
    }
}
