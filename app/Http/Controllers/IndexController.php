<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('pages.Dashboard');
    }

    public function login()
    {
        return view('pages.LoginView');
    }

    public function adminHome()
    {
        return view('pages.MenuDashboard');
    }
}
