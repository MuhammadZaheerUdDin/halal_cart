<?php

// namespace App\View\Components\Admin;
namespace App\Livewire\Admin;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use PragmaRX\Google2FAQRCode\Google2FA;


class TwoFactorAuthComponent extends Component
{
    public $secret;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()//: View|Closure|string
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'You must be logged in to enable 2FA.']);
        }
        $google2fa = new Google2FA();

        $admin->google2fa_secret = $google2fa->generateSecretKey();
        // $admin->save();

        $qrCodeUrl = $google2fa->getQRCodeInline(
            config('app.name'),
            $admin->email,
            $admin->google2fa_secret
        );
        // $this->secret = $admin->google2fa_secret;
        return view('2fa.register', ['qrCodeUrl' => $qrCodeUrl, 'secret' => $admin->google2fa_secret])->layout('layouts.app'); 
        // return view('components.admin.two-factor-auth-component');
    }

    public function enableTwoFactorAuth(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'You must be logged in to enable 2FA.']);
        }
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'You must be logged in to enable 2FA.']);
        }
        // $google2fa = new Google2FA();

        $admin->google2fa_secret = $request->secret;//$this->secret;
        $admin->save();
        
        return redirect()->intended('admin/2fa/verify');

    }
    public function verify()
    {
        return view('2fa.verify')->layout('layouts.app');        
    }
    public function verifyTwoFactorAuth(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($admin->google2fa_secret, $request->input('2fa_code'));

        if ($valid) {
            Auth::guard('admin')->login($admin);
            session(['2fa_verified' => true]);
            session(['google2fa' => true]);            
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
