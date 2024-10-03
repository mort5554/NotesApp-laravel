<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Note;

#[Layout('layouts.noteLayout')]
#[Title('Notes Details')]
class ShowNoteForm extends Component
{

    public $note;

    public function mount($note){
        $this->note = Note::findOrFail($note);

    }
    public function render()
    {
        $note = $this->note;
        return view('livewire.note.show-note-form', ['note' => $note])
            ->layout('layouts.noteLayout');
    }
}
