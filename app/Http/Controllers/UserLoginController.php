<?php

namespace App\Http\Controllers;


class UserLoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }

}
