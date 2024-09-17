@extends('layouts.noteLayout')


@section('document_title')
    Settings
@endsection



@section('content')

<section id="settingsContainer" class="mt-5 p-5 container">
    <div class="new-password-container left-side">

        @session('message')
            <div class="alert alert-info m-3 text-center" role="alert">
                {{ session('message') }}
            </div>
        @endsession
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.change') }}" method="POST">
            <h3 class="mb-3">Zmień hasło</h3>
            @csrf  <!-- Token zabezpieczający -->

            <label for="current_password">Aktualne hasło</label><br>
            <!--<input type="password" id="current_password" name="current_password" class="w-50 my-2"><br>-->
            <div class="field">
                <input type="password" id="current_password" name="current_password">
                <i class="fas fa-user"></i>
            </div>

            <label for="new_password">Nowe hasło</label><br>
            <!--<input type="password" id="new_password" name="new_password" class="w-50 my-2"><br>-->
            <div class="field">
                <input type="password" id="new_password" name="new_password">
                <i class="fas fa-user"></i>
            </div>

            <label for="new_password_confirmation">Potwierdź nowe hasło</label><br>
            <!--<input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-50 my-2"><br>-->
            <div class="field">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                <i class="fas fa-user"></i>
            </div>

             <button type="submit" class="btn btn-primary mt-3">Zmień hasło</button>
        </form>

        <a href="{{ route('user.confirm') }}">
            <button class="btn btn-danger w-25 ms-2 mt-5">Usuń konto</button>
        </a>

    </div>


    <div class="right-side">
        <h3>Twoje konto</h3>
        <div class="row user-information m-1 mt-3">
            <h4>Nazwa:</h4>
            <p>{{ $user->name }}</p>
            <h4>Email:</h4>
            <p>{{ $user->email }}</p>
            <h4>Ilość Notatek:</h4>
            <p>{{ $noteCount }}</p>
        </div>
        <div class="row change-user-name mt-5">
            <form action="{{ route('name.change') }}" method="POST">
                <h3 class="mb-3">Zmień Nazwę</h3>
                @csrf

                <label for="new_name">Nowa nazwa</label><br>
                <div class="field w-50">
                    <input type="text" id="new_name" name="new_name">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Zmień nazwę</button>
            </form>
        </div>
    </div>
</section>


@endsection
