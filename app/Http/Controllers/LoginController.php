<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function doLogin(Request $request) {
        $credential = $request->only('username', 'password');
        if (Auth::attempt($credential)) return redirect()->route('home');
        return redirect()->route('do-login');
    }
}
