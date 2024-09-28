@extends('layouts.noteLayout')

@section('title', 'Notatki')

@section('content')

<section id="notesContainer" class="mx-5">
    @if (session('message'))
        <div class="alert alert-info m-3 text-center" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Komponent Livewire, który obsługuje listowanie notatek -->
    @livewire('note-list')
</section>

@endsection
