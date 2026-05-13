<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * User dashboard / landing page.
     */
    public function dashboard()
    {
        return view('user.dashboard');
    }

    /**
     * User profile page.
     */
    public function profile()
    {
        return view('profile');
    }
}
