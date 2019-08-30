<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserLogin
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
        return $next($request);
        // if user logged in
        if (Auth::check()) {
            $user = Auth::user();
            // if level = 2(user) AND status = 1(activated)
            if ($user->level == 2 && $user->status == 1 ) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('getUserLogin');
            }
        } else {
            return redirect('/home');
        }
    }
}
