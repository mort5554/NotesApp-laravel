<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Log;

class UserController extends Controller
{
    public function logout(Request $request){
        Log::info('Wylogowywanie użytkownika', ['user_id' => Auth::id()]);

        Cache::forget('user_session_'. Auth::id());

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function confirmDelete(){
        return view('auth.confirm-delete');
    }
    public function delete()
    {
        $user = Auth::user();

        // Usunięcie użytkownika spowoduje także usunięcie jego notatek dzięki kaskadowej relacji
        $user->delete();

        // Wylogowanie użytkownika po usunięciu konta
        Auth::logout();

        return redirect(route('login'))->with('message', 'Udało się usunąć konto.');
    }
}
