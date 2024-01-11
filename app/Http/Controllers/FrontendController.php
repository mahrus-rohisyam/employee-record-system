<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function loginView()
    {
        if (!empty(Auth::check()) && Auth::user()->user_type == 1) {
            return redirect('dashboard');
        }
        return view('frontend.login');
    }
    public function registerView()
    {
        return view('frontend.register');
    }

    public function notFoundView()
    {
    }
}
