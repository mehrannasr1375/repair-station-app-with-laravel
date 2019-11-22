<?php
namespace App\Http\Middleware;
use Closure;

class RedirectIfHasNotAdmin
{

    public function handle($request, Closure $next)
    {
        if (! (\App\User::where('id', '=', 1)->first()) ) // show signup page when admin doesn`t signed up
            return redirect('/signup');

        return $next($request);
    }

}
