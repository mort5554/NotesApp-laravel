<section id="settingsContainer" class="mt-5 p-5 container">
    <div class="new-password-container left-side">

        @if (session()->has('message'))
            <div class="alert alert-info m-3 text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger m-3 text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3 class="mb-3">Zmień hasło</h3>
        <form wire:submit.prevent="changePassword">
            <div class="field">
                <input type="password" wire:model="current_password" placeholder="Aktualne hasło">
                <i class="fas fa-lock"></i>
            </div>

            <div class="field">
                <input type="password" wire:model="new_password" placeholder="Nowe hasło">
                <i class="fas fa-lock"></i>
            </div>

            <div class="field">
                <input type="password" wire:model="new_password_confirmation" placeholder="Potwierdź nowe hasło">
                <i class="fas fa-lock"></i>
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
            <form wire:submit.prevent="changeName">
                <h3 class="mb-3">Zmień Nazwę</h3>
                <div class="field w-50">
                    <input type="text" wire:model="name" placeholder="Nowa nazwa">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Zmień nazwę</button>
            </form>
        </div>
    </div>
</section>
