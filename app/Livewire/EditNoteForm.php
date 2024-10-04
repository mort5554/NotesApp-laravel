<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Note;

#[Layout('layouts.noteLayout')]
#[Title('Edit Note')]
class EditNoteForm extends Component
{
    public $noteId;  // Deklarujemy publiczną właściwość na ID notatki
    public $title;
    public $content;
    public $note;

    protected $rules = [
        'title' => 'required|string|max:20|min:3',
        'content' => 'required|string|max:255|min:5',
    ];

    // Usuwamy $id z parametrów metody mount
    public function mount($note)
    {
        $this->noteId = $note;
        $this->note = Note::find($this->noteId);
        if ($this->note) {
            $this->noteId = $this->note->id;
            $this->title = $this->note->title;
            $this->content = $this->note->content;
        } else {
            session()->flash('error', 'Notatka nie została znaleziona');
            return redirect()->route('note.index');
        }
    }

    public function edit()
    {
        $validatedData = $this->validate();

        $this->note = Note::find($this->noteId);

        if ($this->note) {
            $this->note->update($validatedData);

            session()->flash('message', 'Notatka została pomyślnie edytowana');
            return redirect()->route('note.index');
        } else {
            session()->flash('error', 'Wystąpił błąd przy edytowaniu notatki');
        }
    }

    public function render()
    {
        return view('livewire.note.edit-note-form');
    }
}

