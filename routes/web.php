<?php

use App\Http\Controllers\NoteController;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;
use App\Livewire\DeleteNote;
use App\Livewire\EditNoteForm;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserController;
use App\Livewire\ShowNoteForm;
use App\Livewire\NoteList;
use App\Livewire\CreateNoteForm;
use App\Livewire\Auth\UserSettings;
use App\Livewire\Auth\AdminPanel;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckUserSession;

// Przekierowanie z głównej strony na login
Route::redirect('/', '/login', 301);


// Obsługa logowania
Route::get('/login', LoginForm::class)->middleware(CheckRole::class)->name('login');


// Obsługa rejestracji
Route::get('/register', RegisterForm::class)->name('register');


// Obsługa weryfikacji e-maila
Route::get('/email/verify', [UserRegisterController::class, 'showVerify'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [UserRegisterController::class, 'emailVerify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [UserRegisterController::class, 'resendEmailVerify'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');


// Trasy dostępne tylko dla zalogowanych i zweryfikowanych użytkowników
Route::group(['middleware' => ['auth', 'verified', CheckUserSession::class]], function () {
    // Trasy dostępne tylko dla administratorów
    Route::get('/admin', AdminPanel::class)->name('admin')
        ->middleware(CheckRole::class);

    //Trasy notatek
    Route::get('note', NoteList::class)->name('note.index')
        ->middleware(CheckRole::class);

    Route::get('/note/{note}', ShowNoteForm::class)->name('note.show');

    Route::get('/note/create', CreateNoteForm::class)->name('note.create');

    Route::get('/note/{note}/edit', EditNoteForm::class)->name('note.edit');

    Route::get('/note/{note}/delete', DeleteNote::class)->name('note.destroy');

    // Wylogowanie użytkownika
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

    // Ustawienia użytkownika
    Route::get('/settings', UserSettings::class)->name('user.settings');

    // Zmiana hasła i nazwy użytkownika
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/change-name', [UserController::class, 'changeName'])->name('name.change');

    // Potwierdzenie usunięcia konta
    Route::get('/confirm_delete', [UserController::class, 'confirmDelete'])->name('user.confirm');
    Route::delete('/delete', [UserController::class, 'delete'])->name('user.delete');
});
