<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;

class EditNoteForm extends Component
{
    public $noteId;
    public $title;
    public $content;

    protected $rules = [
        'title' => 'required|string|max:20|min:3',
        'content' => 'required|string|max:255|min:5',
    ];

    public function mount($id)
    {
        // Znajdujemy notatkę na podstawie ID i przypisujemy wartości
        $note = Note::find($id);
        if ($note) {
            $this->noteId = $note->id;
            $this->title = $note->title;
            $this->content = $note->content;
        }
    }

    public function edit()
    {
        // Walidacja danych
        $validatedData = $this->validate();

        // Znajdź istniejącą notatkę na podstawie ID i zaktualizuj dane
        $note = Note::find($this->noteId);
        if ($note) {
            $note->update($validatedData);

            // Resetujemy pola i wyświetlamy komunikat
            session()->flash('message', 'Udało się edytować notatkę');
            $this->reset(['title', 'content']);

            // Przekierowanie do listy notatek
            return redirect()->route('note.index');
        }
    }

    public function render()
    {
        return view('livewire.note.edit-note-form');
    }
}
