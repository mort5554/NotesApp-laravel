<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Note;

#[Layout('layouts.noteLayout')]
#[Title('Notes')]
class NoteList extends Component
{
    use WithPagination;

    public function render()
    {
        // Pobieranie notatek w metodzie render
        $notes = Note::query()
            ->where('user_id', request()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(8);

        // Zwracanie widoku Livewire z notatkami
        return view('livewire.note.note-list', ['notes' => $notes]);
    }
}
