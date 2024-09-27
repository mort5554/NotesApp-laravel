<nav class="row navigation">
    <div class="left-side">
        <a href="{{ route('note.index') }}">Twoje Notatki</a>
        <a href="{{ route('note.create') }}" class="create-note">
            <button style="--c: #454a55;--b: 5px;--s:10px">Utwórz notatkę</button>
        </a>
    </div>
    <div class="right-side">
        <a href="{{ route('user.settings') }}">Ustawienia</a>
        <a href="{{ route('user.logout') }}">Wyloguj się</a>
    </div>
</nav>
