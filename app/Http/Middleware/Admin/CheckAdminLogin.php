<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Auth;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if user logged in
        if (Auth::check()) {
            $user = Auth::user();
            // if level = 1(admin) AND status = 1(activated)
            if ($user->level == 1 && $user->status == 1 ) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('getLogin');
            }
        } else {
            return redirect('admincp/login');
        }
    }
}
