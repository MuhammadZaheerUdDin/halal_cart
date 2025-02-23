<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class NewsletterSubscription extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email|max:255|unique:newsletter_subscribers,email',
    ];

    public function subscribe()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to subscribe.');
            return;
        }

        $user = Auth::user();

        // Rate limiting: 1 request per minute
        if (RateLimiter::tooManyAttempts('subscribe-'.$user->id, 1)) {
            session()->flash('error', 'Too many attempts. Please try again later.');
            return;
        }

        RateLimiter::hit('subscribe-'.$user->id, 60); // Allow 1 request per 60 seconds

        // Check if the user already subscribed
        $existingSubscription = DB::table('newsletter_subscribers')->where('user_id', $user->id)->exists();
        if ($existingSubscription) {
            session()->flash('error', 'You have already subscribed.');
            return;
        }

        // Store the email and associate it with the logged-in user
        DB::table('newsletter_subscribers')->insert([
            'user_id' => $user->id,
            'email' => $this->email,
            'created_at' => now(),
        ]);

        // Send confirmation email (optional)
        Mail::raw('Thank you for subscribing to our newsletter!', function ($message) {
            $message->to($this->email)->subject('Newsletter Subscription');
        });

        // Reset email input
        $this->reset('email');

        session()->flash('message', 'Subscription successful!');
    }

    public function render()
    {
        return view('livewire.user.newsletter-subscription');
    }
}
