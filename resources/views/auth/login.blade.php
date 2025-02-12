{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}
<x-guest-layout>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/imgs/bg-01.png');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-6 p-b-3" style="width:500px !important">
                <form class="login100-form validate-form flex-sb flex-w"  method="POST" action="{{ route('login') }}">
                        @csrf
            
                    <span class="login100-form-title p-b-20">
                        <img src="{{ url('assets/imgs/meet-logo.png') }}" class="wid-img">
                    </span>
                    
                    {{-- <a href="#" class="btn-face m-b-20" style="height:45px">
                        <i class="fa fa-facebook-official"></i>
                        Facebook
                    </a>

                    <a href="#" class="btn-google m-b-20" style="height:45px">
                        <img src="assets/imgs/icons/icon-google.png" alt="GOOGLE">
                        Google
                    </a> --}}
                    <div class="col-md-12">
                    <x-validation-errors class="mb-4" />
                    {{-- @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ $value }}
                        </div>
                    @endsession --}}
                    </div>
                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Username
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        {{-- <input class="input100" type="text" name="username" style="height: 40px"> --}}
                        <x-input class="block mt-1 w-full input100" id="email" type="email" name="email" :value="old('email')"
                         required autofocus autocomplete="username" />
                        <span class="focus-input100"></span>
                    </div>
                    
                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Password
                        </span>

                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        {{-- <input class="input100" type="password" name="pass"  style="height: 40px"> --}}
                        <x-input id="password" class="block mt-1 w-full input100" type="password" name="password"
                         required autocomplete="current-password" />

                        <span class="focus-input100"></span>
                    </div>
    
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            Sign In
                        </button>
                    </div>

                    <div class="w-full text-center p-t-35">
                        <span class="txt2">
                            Not a member?
                        </span>

                        <a href="{{ url('register') }}" class="txt2 bo1">
                            Sign up now
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>