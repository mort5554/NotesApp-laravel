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
