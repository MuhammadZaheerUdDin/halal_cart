<?php

namespace App\Livewire\User;

use App\Repositories\NewsletterRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class NewsletterSubscription extends Component
{
     public $email;
    protected $rules = ['email' => 'required|email|max:255|unique:newsletter_subscribers,email'];

    protected $repository;

    public function __construct()
    {
        $this->repository = new NewsletterRepository();
    }

    public function subscribe()
    {
        $this->validate();

        $result = $this->repository->subscribeUser($this->email);

        if (isset($result['error'])) {
            session()->flash('error', $result['error']);
        } else {
            session()->flash('message', $result['success']);
            $this->reset('email');
        }
    }

    public function render()
    {
        return view('livewire.user.newsletter-subscription');
    }
}
