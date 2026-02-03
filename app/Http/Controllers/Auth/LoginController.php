<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(StoreLoginRequest $request)
    {
        $data = $request->validated();

        if (! Auth::attempt($data)) {
            return back()->withInput()->withErrors(['password' => 'E-Mail oder Passwort nicht korrekt!']);
        }

        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->intended('/');
    }
}
