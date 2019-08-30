<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

class UserLoginController extends Controller
{
    public function getUserLogin()
    {
        if (Auth::check()) {
            // if login successful, redirect to Home page
            return redirect('home');
        } else {
            return view('layouts.login');
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  LoginRequest $request
     *
     * @return Response
     */
    public function postUserLogin(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'level' => 2,
            'status' => 1,
        ];

        $validator = Validator::make(
          $request->all(),
          $request->rules(),
          $request->messages()
        );

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect('home');
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
