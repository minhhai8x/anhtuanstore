<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\LoginRequest;

use Auth;
use App\Model\User;

class AdminLoginController extends Controller
{

    public function getLogin()
    {
        if (Auth::check()) {
            // if login successful, redirect to Admin control panel page
            return redirect('admincp');
        } else {
            return view('admin.login');
        }

    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'level' => 1,
            'status' => 1
        ];
        if (Auth::attempt($login)) {
            return redirect('admincp');
        } else {
            return redirect()->back()->with('status', 'Email or Password is incorrect.');
        }
    }

    /**
     * action admincp/logout
     * @return RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }

}
