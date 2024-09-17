@extends('layouts.layout')


@section('document_title')
    Zweryfikuj Email
@endsection



@section('content')

<section id="verifyContainer">
    <section class="verify">
        @session('message')
                <div class="alert alert-info m-3 text-center" role="alert">
                    {{ session('message') }}
                </div>
        @endsession
        <h1>Wysłano link do weryfikacji konta na podany email</h1>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="resend-email mt-5" type="submit" style="--c: #b0b7c5;--b: 5px;--s:10px">Wyślij ponownie link weryfikacyjny</button>
        </form>
    </section>

</section>


@endsection
