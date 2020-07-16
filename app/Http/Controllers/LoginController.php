<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function doLogin(Request $request) {
        $credential = $request->only('username', 'password');
//        dd($credential);
        if (Auth::attempt($credential)) {
            return view('dashboard.index');
        }
        return view('login.index');
    }
}
