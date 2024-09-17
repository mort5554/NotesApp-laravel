<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserController;


Route::redirect('/', '/login', 301);

Route::redirect('/login', '/login')->name('login');
Route::get('/login', [UserLoginController::class, 'show'])->name('login.show');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.login');


Route::get('/register', [UserRegisterController::class, 'show'])->name('register.show');
Route::post('/register', [UserRegisterController::class, 'register'])->name('register.register');

Route::get('/email/verify', [UserRegisterController::class, 'showVerify'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [UserRegisterController::class, 'emailVerify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [UserRegisterController::class, 'resendEmailVerify'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('note', NoteController::class);
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');

    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change');

    Route::post('/change-name', [UserController::class, 'changeName'])->name('name.change');

    Route::get('/confirm_delete', [UserController::class, 'confirmDelete'])->name('user.confirm');
    Route::delete('/delete', [UserController::class, 'delete'])->name('user.delete');
});

