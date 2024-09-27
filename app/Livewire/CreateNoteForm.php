<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class CreateNoteForm extends Component
{
    public $title;
    public $content;

    protected $rules = [
        'title' => 'required|string|max:20|min:3',
        'content' => 'required|string|max:255|min:5'
    ];

    public function create()
    {
        // Walidacja danych
        $validatedData = $this->validate();

        // Dodanie user_id i utworzenie notatki
        Note::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),
        ]);

        // Wyświetlenie wiadomości sukcesu i resetowanie formularza
        session()->flash('message', 'Udało się utworzyć notatkę');
        $this->reset(['title', 'content']);

        // Przekierowanie na stronę listy notatek
        return redirect()->route('note.index');
    }

    public function render()
    {
        return view('livewire.note.create-note-form');
    }
}
