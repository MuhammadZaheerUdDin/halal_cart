<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class VerifyTwoFactorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();
        // dd(session()->all());
        // dd($admin);
        if ($admin && $admin->google2fa_enabled && !session('google2fa')) {
            return redirect()->route('admin.2fa.verify');
        }
        // dd('VerifyTwoFactorAuth');
        // if ($admin->google2fa_secret && !session('2fa_verified')) {
        //     return redirect()->route('admin.2fa.verify');
        // }else{
        //     if ($admin->google2fa_enabled) {
        //         return redirect()->route('admin.2fa.enable');
        //     }
        // }
        // $user = $request->user();

        // if ($user && $user->google2fa_enabled) {
        //     $authenticator = new Authenticator($request);

        //     if (!$authenticator->isAuthenticated()) {
        //         return redirect()->route('admin.2fa.enable');
        //     }
        // }

        return $next($request);
    }
}
