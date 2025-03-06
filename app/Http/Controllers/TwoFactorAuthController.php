<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthController extends Controller
{
    public function enableTwoFactorAuth()
    {
        // dd(Auth::user());
        // dd('za');
        // $user = Auth::user();
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'You must be logged in to enable 2FA.']);
        }
        $google2fa = new Google2FA();

        $admin->google2fa_secret = $google2fa->generateSecretKey();
        $admin->save();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $admin->email,
            $admin->google2fa_secret
        );

        return view('2fa.enable', ['qrCodeUrl' => $qrCodeUrl, 'secret' => $admin->google2fa_secret])->layout('admin.layouts.app');
    }

    public function verifyTwoFactorAuth(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($admin->google2fa_secret, $request->input('2fa_code'));

        if ($valid) {
            // 2FA code is valid, proceed with login
            return redirect()->intended('admin/dashboard');
        } else {
            // Invalid 2FA code
            return redirect()->back()->withErrors(['2fa_code' => 'Invalid 2FA code.']);
        }
            // if ($valid) {
        //     $admin->google2fa_enabled = true;
        //     $admin->save();

        //     return redirect()->route('home')->with('success', '2FA enabled successfully!');
        // }

        // return back()->withErrors(['2fa_code' => 'Invalid 2FA code.']);
    }
}
