<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $user = Auth::user();

                if ($user->role == 'seller' && $guard == 'seller') {
                return redirect()->route('seller-dashboard');
                } elseif ($user->role == 'buyer' && $guard == 'buyer') {

                    return redirect()->route('buyer-dashboard');

                } else {
                    return redirect()->back()->with(['failure' => 'Invalid user Role']);
                }
            }
        }

        return $next($request);
    }
}
