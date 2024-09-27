<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;

class ShowNoteForm extends Component
{

    public $note;

    public function mount($id){
        $this->note = Note::findOrFail($id);

    }
    public function render()
    {
        $note = $this->note;
        return view('livewire.note.show-note-form', ['note' => $note])
            ->layout('layouts.noteLayout');
    }
}
