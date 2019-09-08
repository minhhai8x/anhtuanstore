<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Requests\LoginRequest;

class UserLoginController extends Controller
{
    public function getUserLogin()
    {
        if (Auth::check()) {
            // if login successful, redirect to Home page
            return redirect(app()->getLocale());
        } else {
            return view('layouts.login');
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function postUserLogin(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'level' => 2,
            'status' => 1,
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect(app()->getLocale());
        } else {
            return redirect()->back()->with('status', 'Email or Password is incorrect.');
        }
    }

    /**
     * action logout
     * @return RedirectResponse
     */
    public function getUserLogout()
    {
        Auth::logout();
        return redirect()->route('getUserLogin');
    }
}
