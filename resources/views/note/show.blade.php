@extends('layouts.noteLayout')

@section('title', 'Pokaż Notatkę')

@section('content')
    <section id="note" class="container">
        <h1 class="pt-5 text-center">Szczegóły notatki</h1>

        @livewire('show-note-form', ['id' => $note->id])
    </section>
@endsection
