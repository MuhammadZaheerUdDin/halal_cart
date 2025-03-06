<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showLoginForm()
    {
        if(!empty(Auth::user())){
            if(empty(Auth::user()->user_roles)){
                Auth::logout(); // Log the user out
                Session::flush(); // Clear the session data
                return redirect('/login')->with('message', 'You have been logged out due to missing user roles.');            
            }
            return redirect('admin/dashboard');
        }
        return view('admin.admin_login')->layout('layouts.app'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            $admin = Auth::guard('admin')->user();
            // dd($admin);
            // if ($admin->google2fa_secret) {
            if ($admin->google2fa_enabled) {
                    // 2FA is enabled, redirect to 2FA verification page
                if (empty($admin->google2fa_secret)) {
                    return redirect()->route('admin.2fa.register');
                }else{
                    return redirect()->route('admin.2fa.verify');
                }
            } else {
                // 2FA is not enabled, proceed to dashboard
                return redirect()->intended('admin/dashboard');
            }
            // return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
