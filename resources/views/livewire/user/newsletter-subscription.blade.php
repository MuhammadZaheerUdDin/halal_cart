<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- @auth --}}
        {{-- <form wire:submit.prevent="subscribe"> --}}
            {{-- <input type="email" placeholder="Enter Email Address" />
            <button type="submit">
                <span>&#8594;</span> <!-- Arrow Icon -->
            </button> --}}
            {{-- <input type="email" wire:model="email" placeholder="Enter your email" required class="email-input">
            @error('email') <span class="error">{{ $message }}</span> @enderror
            <button type="submit" class="subscribe-btn">Subscribe</button>
        </form> --}}
        <form wire:submit.prevent="subscribe">
            <h2 class="ft-clr">Get premium meat delivered direct <span style="font-size: 35px; font-family: 'Brush Script MT', cursive; color : #ffd700;">to you</span>.</h2>
            <div class="email-input">
                {{-- <input type="email" placeholder="Enter Email Address" /> --}}
                <input type="email" wire:model="email" placeholder="Enter your email" required class="email-input">
                @error('email') <span class="error">{{ $message }}</span> @enderror                
                <button type="submit">
                    <span>&#8594;</span> <!-- Arrow Icon -->
                </button>
            </div>
        </form>

    {{-- @else
        <p class="login-message">Please <a href="{{ route('login') }}">log in</a> to subscribe.</p>
    @endauth --}}

{{-- <style>
    .newsletter-container { text-align: center; margin-top: 20px; }
    .email-input { padding: 10px; width: 250px; border-radius: 5px; border: 1px solid #ccc; }
    .subscribe-btn { padding: 10px 15px; border: none; background-color: #007bff; color: white; border-radius: 5px; cursor: pointer; }
    .error { color: red; font-size: 12px; }
    .alert { margin-top: 10px; padding: 10px; border-radius: 5px; }
    .alert-success { background-color: #d4edda; color: #155724; }
    .alert-danger { background-color: #f8d7da; color: #721c24; }
    .login-message { font-size: 14px; color: #333; }
</style> --}}
</div>