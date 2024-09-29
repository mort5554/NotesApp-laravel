@extends('layouts.noteLayout')

@section('title', 'Edytuj Notatkę')

@section('content')

@livewire('edit-note-form', ['id' => $note->id])

@endsection
