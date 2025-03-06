<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.admin.users-list')->layout('admin.layouts.app');
    }
}
