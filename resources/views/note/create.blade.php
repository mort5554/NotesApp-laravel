@extends('layouts.noteLayout')

@section('title', 'Utwórz Notatkę')

@section('content')
    <section id="note" class="container">
        <h1 class="pt-5 text-center">Stwórz nową notatkę</h1>

        @livewire('create-note-form')

    </section>
@endsection
