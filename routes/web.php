<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Livewire\ShowNoteForm;
use App\Livewire\NoteList;

// Przekierowanie z głównej strony na login
Route::redirect('/', '/login', 301);


// Obsługa logowania
Route::get('/login', [UserLoginController::class, 'show'])->name('login.show');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.login');


// Obsługa resetowania hasła
/*Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');*/


// Obsługa rejestracji
Route::get('/register', [UserRegisterController::class, 'show'])->name('register.show');
Route::post('/register', [UserRegisterController::class, 'register'])->name('register.register');


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
    Route::resource('note', NoteController::class);

    //Route::get('note', NoteList::class)->name('note.index');

    //Route::get('/note/{id}', ShowNoteForm::class)->name('note.show');

    // Trasa do tworzenia notatki za pomocą Livewire (przesłania standardową metodę create)
    //Route::get('note/create', NoteController::class, )->name('note.create');


    // Wylogowanie użytkownika
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');


    // Ustawienia użytkownika
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');


    // Zmiana hasła i nazwy użytkownika
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/change-name', [UserController::class, 'changeName'])->name('name.change');


    // Potwierdzenie usunięcia konta
    Route::get('/confirm_delete', [UserController::class, 'confirmDelete'])->name('user.confirm');
    Route::delete('/delete', [UserController::class, 'delete'])->name('user.delete');
});
