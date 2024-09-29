<section id="loginContainer">
    <div class="content">
        <div class="text">
            Rejestracja
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

        <form wire:submit.prevent="register">
            <div class="field">
                <input type="text" wire:model="name" required>
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                <label>Nazwa</label>
            </div>

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

            <div class="field">
                <input type="password" wire:model="password_confirmation" required>
                <i class="fa fa-lock" aria-hidden="true"></i>
                <label>Powtórz Hasło</label>
            </div>

            <button type="submit">Zarejestruj się</button>

            <div class="sign-up">
                Masz już konto?
                <a href="{{ route('login') }}">Zaloguj się</a>
            </div>
        </form>
    </div>
</section>
