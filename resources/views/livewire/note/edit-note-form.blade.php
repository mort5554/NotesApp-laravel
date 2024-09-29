<section id="note" class="container">
    <h1 class="pt-5 text-center">Edytuj notatkę</h1>
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

    <form wire:submit='edit' method="POST" class="note mt-5 container">
        <label for="title" class="mt-3">Wpisz tytuł notatki</label>
        <input type="text" wire:model='title' id="title" class="mb-3" required>
        <textarea wire:model='content' rows="5" class="note-body" placeholder="Wpisz zawartość notatki tutaj" required></textarea>
        <div class="buttons py-3">
            <a href="{{ route('note.index') }}" class="btn btn-danger">Wróć</a>
            <button type="submit" class="btn btn-success mx-3">Edytuj</button>
        </div>
    </form>
    </div>
</section>
