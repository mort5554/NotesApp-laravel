@extends('layouts.noteLayout')

@section('title', 'Edytuj Notatkę')

@section('content')
    <section id="note" class="container">
        <h1 class="pt-5 text-center">Edytuj notatkę</h1>
        <div class="errors mt-3">
            @if ($errors->any())
                <div class="alert alert-danger w-50">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form action="{{ route('note.update', $note) }}" method="POST" class="note mt-5 container">
            @method('PUT')
            @csrf
            <label for="title" class="mt-3">Wpisz tytuł notatki</label>
            <input type="text" name="title" id="title" class="mb-3" value="{{ $note->title }}" required>
            <textarea name="content" rows="5" class="note-body" placeholder="Wpisz zawartość notatki tutaj" required>{{ $note->content }}</textarea>
            <div class="buttons py-3">
                <a href="{{ route('note.index') }}" class="btn btn-danger">Wróć</a>
                <button type="submit" class="btn btn-success mx-3">Edytuj</button>
            </div>
        </form>
        </div>
    </section>
@endsection
