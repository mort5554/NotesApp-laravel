<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Note;

#[Layout('layouts.noteLayout')]
#[Title('Edit Note')]

class DeleteNote extends Component
{
    public $noteId;

    public function mount($note)
    {
        $this->noteId = $note;
        $this->destroy();
    }

    public function destroy()
    {
        $note = Note::find($this->noteId);

        if ($note) {
            $note->delete();

            session()->flash('message', 'Notatka została pomyślnie usunięta');
            return redirect()->route('note.index');
        } else {
            session()->flash('error', 'Notatka nie została znaleziona');
            return redirect()->route('note.index');
        }
    }
}
