<div>
    <div class="form-container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="create" class="form-content">
            <div class="form-group">
                <label for="title">Tytuł</label>
                <input type="text" id="title" wire:model="title" class="form-control">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="content">Treść</label>
                <textarea id="content" wire:model="content" class="form-control"></textarea>
                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Dodaj Notatkę</button>
        </form>
    </div>

    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #b8d8d8;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-content {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-bottom: 20px;
            padding: 15px;
            color: white;
            background-color: #28a745;
            border-radius: 4px;
        }

        .text-danger {
            color: red;
            font-size: 14px;
        }
    </style>
</div>
