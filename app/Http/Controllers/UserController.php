<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function show(User $user){
        $user = Auth::user();
        $noteCount = $user->notes()->count();
        return view('auth.settings');
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
