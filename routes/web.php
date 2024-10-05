<?php

use App\Http\Controllers\NoteController;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;
use App\Livewire\DeleteNote;
use App\Livewire\EditNoteForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Livewire\ShowNoteForm;
use App\Livewire\NoteList;
use App\Livewire\CreateNoteForm;
use App\Livewire\Auth\UserSettings;

// Przekierowanie z głównej strony na login
Route::redirect('/', '/login', 301);


// Obsługa logowania
Route::get('/login', LoginForm::class)->name('login');
//Route::get('/login', [UserLoginController::class, 'show'])->name('login');
//Route::post('/login', [UserLoginController::class, 'login'])->name('login.login');


// Obsługa resetowania hasła
/*Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');*/


// Obsługa rejestracji
Route::get('/register', RegisterForm::class)->name('register');
//Route::get('/register', [UserRegisterController::class, 'show'])->name('register.show');
//Route::post('/register', [UserRegisterController::class, 'register'])->name('register.register');


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
Route::group(['middleware' => ['auth', 'verified']], function () {

    // Trasy resource'owe do obsługi notatek
    Route::resource('note', NoteController::class)->except('index');


    // Trasa do tworzenia notatki za pomocą Livewire (przesłania standardową metodę create)
    Route::get('note', NoteList::class)->name('note.index');

    Route::get('/note/{note}', ShowNoteForm::class)->name('note.show');

    Route::get('note/create', CreateNoteForm::class)->name('note.create');

    Route::get('note/{note}/edit', EditNoteForm::class)->name('note.edit');

    Route::get('note/{note}/delete', DeleteNote::class)->name('note.destroy');

    // Wylogowanie użytkownika
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');


    // Ustawienia użytkownika
    Route::get('/settings', UserSettings::class)->name('user.settings');
    //Route::get('/settings', [UserController::class, 'show'])->name('user.settings');


    // Zmiana hasła i nazwy użytkownika
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/change-name', [UserController::class, 'changeName'])->name('name.change');


    // Potwierdzenie usunięcia konta
    Route::get('/confirm_delete', [UserController::class, 'confirmDelete'])->name('user.confirm');
    Route::delete('/delete', [UserController::class, 'delete'])->name('user.delete');
});
