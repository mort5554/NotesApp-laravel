<div class="row note-container mt-5">
    @if (session('message'))
    <div class="row alert-container">

            <div class="alert alert-info m-3 mb-5 text-center" role="alert">
                {{ session('message') }}
            </div>

    </div>
    @endif

    @foreach ($notes as $note)
        <div class="note m-3 col-sm-6 col-md-4">
            <h2 class="mt-3">{{ $note->title }}</h2>
            <p>{{ $note->updated_at->format('d-m H:i') }}</p>
            <div class="note-body">
                <h4>{{ Str::words($note->content, 30) }}</h4>
            </div>
            <div class="buttons">
                <a href="{{ route('note.show', $note) }}" wire:loading.attr="disabled">
                    <img src="{{ Storage::url('public/imgs/eye-outline.svg') }}" alt="View Note" class="img">
                </a>

                <a  href="{{ route('note.edit', $note) }}" wire:loading.attr="disabled">
                    <img src="{{ Storage::url('public/imgs/file-edit-outline.svg') }}" alt="Edit Note" class="img">
                </a>

                <a href="{{ route('note.destroy', $note) }}" wire:loading.attr="disabled" class="btn-submit">
                    <img src="{{ Storage::url('public/imgs/trash-can-outline.svg') }}" alt="Delete Note" class="img">
                </a>

            </div>
        </div>
    @endforeach

    <!-- Dodanie paginacji Livewire -->
    <div class="row justify-content-center mt-4">
        {{ $notes->links('vendor.pagination.custom') }}
    </div>
</div>
