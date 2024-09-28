<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
//use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function settings()
    {
        $user = Auth::user();  // Pobranie zalogowanego użytkownika
        $noteCount = $user->notes()->count();

        return view('auth.settings', [
            'user' => $user,
            'noteCount' => $noteCount
        ]);
    }

    public function changePassword(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',  // "confirmed" sprawdza czy nowe hasło zostało potwierdzone poprawnie
        ]);

        $user = Auth::user();

        // Sprawdzenie, czy podane aktualne hasło jest poprawne
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Aktualne hasło jest nieprawidłowe.']);
        }

        // Zaktualizowanie hasła
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Hasło zostało zmienione pomyślnie.');
    }


    public function changeName(Request $request){
        $request->validate([
            'new_name' => 'required|min:3|max:255'
        ]);

        $user = Auth::user();

        $user->name = $request->new_name;
        $user->save();

        return back()->with('message', 'Nazwa została pomyślnie zmieniona!');
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

        return redirect(route('login.show'))->with('message', 'Udało się usunąć konto.');
    }
}
