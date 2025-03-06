<?php
namespace App\Repositories;

// use App\Models\NewsletterSubscriber;
use App\Models\User\NewsletterSubscriber as UserNewsletterSubscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class NewsletterRepository
{
    public function subscribeUser($email)
    {
        // Ensure the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return ['error' => 'You must be logged in to subscribe.'];
        }

        // Rate limiting: 1 request per minute
        if (RateLimiter::tooManyAttempts('subscribe-'.$user->id, 1)) {
            return ['error' => 'Too many attempts. Please try again later.'];
        }

        RateLimiter::hit('subscribe-'.$user->id, 60); // Limit 1 request per minute

        // Check if the user has already subscribed
        if (UserNewsletterSubscriber::where('user_id', $user->id)->exists()) {
            return ['error' => 'You have already subscribed.'];
        }

        // Create the subscription
        UserNewsletterSubscriber::create([
            'user_id' => $user->id,
            'email' => $email,
        ]);

        return ['success' => 'Subscription successful!'];
    }
}
