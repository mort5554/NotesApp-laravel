@extends('layouts.noteLayout')


@section('document_title')
    Register
@endsection



@section('content')
<section id="confirmDelete" class="container">
    <div class="confirm-container">
        <h1>Czy jestś pewny że chcesz usunąć konto?</h1>
        <div class="buttons-container">

            <div class="delete-account-container mt-5">
                <form action="{{ route('user.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Tak usuń!</button>
                </form>
                <a href="{{ route('user.settings') }}">
                    <button class="btn btn-secondary">Wróć</button>
                </a>
            </div>
        </div>

    </div>

</section>


@endsection
