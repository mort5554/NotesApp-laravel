@extends('layouts.layout')


@section('document_title')
    Login
@endsection



@section('content')

<section id="loginContainer">
    <div class="content">
        <div class="text">
           Logowanie
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @session('message')
                <div class="alert alert-info m-3 text-center" role="alert">
                    {{ session('message') }}
                </div>
            @endsession

        <form action="{{ route('login.login')}}" method="post">
            @csrf
            @method('post')

           <div class="field">
              <input type="text" value="{{old('email')}}" name="email" required>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <label>Email</label>
           </div>

           <div class="field">
                <input type="password" name="password" required>
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <label>Hasło</label>
           </div>
           <!--<div class="forgot-pass">
              <a href="#">Zapomniałeś hasła?</a>
           </div>-->
           <button type="submit">Zaloguj się</button>
           <div class="sign-up">
              Nie masz konta?
              <a href="{{ route('register.show') }}">Zarejestruj się</a>
           </div>
        </form>
    </div>
</section>


@endsection
