<div class="background-gradient p-5">
    <nav class="navigation">
        <h1>Strona Administratora</h1>
        <a class="btn btn-danger text-decoration-none" href="{{ route('user.logout') }}">Wyloguj</a>
    </nav>
    <div class="left-side mt-5">
        <h1>Lista wszystkich użytkowników</h1>
        <div class="flex justify-between items-center">
            <div class="flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" style="width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input wire:model.live.debounce.500ms='search' type="text" placeholder="Szukaj..."
                    class="bg-gray-100 ml-2 rounded px-4 py-2 hover:bg-gray-100" />
            </div>
        </div>
        <table class="table w-25 mt-4">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwa</th>
                <th scope="col">email</th>
                <th scope="col">Ilość notatek</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->notes->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links('vendor.pagination.custom') }}

    </div>
</div>
