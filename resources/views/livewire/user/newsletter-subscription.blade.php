<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror                

    <form wire:submit.prevent="subscribe">
        <h2 class="ft-clr">Get premium meat delivered direct <span style="font-size: 35px; font-family: 'Brush Script MT', cursive; color : #ffd700;">to you</span>.</h2>
        <div class="email-input">
            {{-- <input type="email" placeholder="Enter Email Address" /> --}}
            <input type="email" wire:model="email" placeholder="Enter your email" required class="email-input">
            <button type="submit">
                <span>&#8594;</span> <!-- Arrow Icon -->
            </button>
        </div>
    </form>

</div>