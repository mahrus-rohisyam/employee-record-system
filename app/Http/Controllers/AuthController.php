<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        // dd($request);`

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, $remember])) {
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('error', 'please enter your email and password correctly');
        }
    }
    public function register(Request $request)
    {
        dd($request);
        return view('frontend.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgotPassword()
    {
    }
}
