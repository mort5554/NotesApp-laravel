
@extends('layouts.noteLayout')

@section('title', 'Utwórz Notatkę')

@section('content')
    <section id="note" class="container">
        <h1 class="pt-5 text-center">Stwórz nową notatkę</h1>

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

        <form action="{{ route('note.store') }}" method="POST" class="note mt-5 container">
            @method('POST')
            @csrf
            <label for="title" class="mt-3">Wpisz tytuł notatki</label>
            <input type="text" name="title" id="title" class="mb-3" value="{{ old('title') }}" required>
            <textarea name="content" rows="10" class="note-body" placeholder="Wpisz zawartość notatki tutaj" value="{{ old('content') }}" required></textarea>
            <div class="buttons py-3">
                <a href="{{ route('note.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-success mx-3">Utwórz</button>
            </div>
        </form>
        </div>
    </section>
@endsection
