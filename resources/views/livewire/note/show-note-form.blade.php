<div>
    @if ($errors->any())
        <div class="alert alert-danger w-50">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="pt-5 text-center">Szczegóły notatki</h1>
    <div class="note mt-5 container">


        <label for="title" class="mt-3">Tytuł notatki</label>
        <input type="text" name="title" id="title" class="mb-3" value="{{ $note->title }}" disabled>
        <div class="note-body bg-white p-2 text-start" style="border:1px solid black">
            {{ $note->content }}
        </div>
        <div class="buttons">
            <a href="{{ route('note.index') }}" class="btn btn-danger mb-2">Wróć</a>

            <a href="{{ route('note.edit', $note) }}">
                <img src="{{ Storage::url('public/imgs/file-edit-outline.svg') }}" alt="Edit Note" class="img">
            </a>

            <form action="{{ route('note.destroy', $note) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-submit">
                    <img src="{{ Storage::url('public/imgs/trash-can-outline.svg') }}" alt="Delete Note" class="img">
                </button>
            </form>
        </div>
    </div>
</div>
