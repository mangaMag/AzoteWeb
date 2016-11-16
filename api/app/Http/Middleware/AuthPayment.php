<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class AuthPayment
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
        $user = User::where('ticket', $request->input('ticket'))->first();

        if ($user)
        {
            Auth::login($user);
        }
        else
        {
            return redirect()->to('error');
        }

        return $next($request);
    }
}