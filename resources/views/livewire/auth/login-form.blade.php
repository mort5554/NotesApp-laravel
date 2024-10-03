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

        @if (session('message'))
            <div class="alert alert-info m-3 text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="login">
            <div class="field">
                <input type="text" wire:model="email" required>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <label>Email</label>
            </div>

            <div class="field">
                <input type="password" wire:model="password" required>
                <i class="fa fa-lock" aria-hidden="true"></i>
                <label>Hasło</label>
            </div>

            <button type="submit">Zaloguj się</button>
            <div class="sign-up">
                Nie masz konta?
                <a href="{{ route('register') }}">Zarejestruj się</a>
            </div>
        </form>
    </div>
</section>
