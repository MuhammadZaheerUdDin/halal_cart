<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;
// use Illuminate\Validation\ValidationException;

class ProfileComponent extends Component
{
    public $old_password;
    public $password;

    public function render()
    {
        return view('livewire.user.profile-component')->layout('layouts.app');
    }

    public function updatePassword(){
        $validatedData = $this->validate([
            'old_password' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = auth()->user();
        if (!Hash::check($this->old_password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'old_password' => ['The provided old password is incorrect.']
            // ]);
            session()->flash('error', 'The provided old password is incorrect.');
        }

        // Update the password
        $user->update([
            'password' => Hash::make($this->password),
        ]);
        session()->flash('success', 'Password updated successfully.');

    }
}
