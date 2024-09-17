<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserRegisterController extends Controller
{
    public function show(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('verification.notice'));
    }

    public function showVerify(){
        return view('auth.verify-email');
    }

    public function emailVerify(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect('/note');
    }

    public function resendEmailVerify(Request $request){
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Wysłano link do weryfikacji!');
    }
}
