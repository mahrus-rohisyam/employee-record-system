<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function loginView()
    {
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
