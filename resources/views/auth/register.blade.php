<x-guest-layout>
    {{-- <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card> --}}

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/imgs/bg-01.png');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-6 p-b-3" style="width:500px !important">
                <form class="login100-form validate-form flex-sb flex-w"  method="POST"  action="{{ route('register') }}">
                        @csrf
            
                    <span class="login100-form-title p-b-20">
                        <img src="assets/imgs/meet-logo.png" class="wid-img">
                    </span>
                    
                    <a href="#" class="btn-face m-b-20" style="height:50px">
                        <i class="fa fa-facebook-official"></i>
                        Facebook
                    </a>

                    <a href="#" class="btn-google m-b-20" style="height:50px">
                        <img src="assets/imgs/icons/icon-google.png" alt="GOOGLE">
                        Google
                    </a>
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
                            Name
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <x-input class="block mt-1 w-full input100" id="name" type="name" name="name" :value="old('name')"
                         required autofocus autocomplete="name" />
                         <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Email
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <x-input class="block mt-1 w-full input100" id="email" type="name" name="email" :value="old('email')"
                         required autofocus autocomplete="email" />
                         <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Password
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <x-input class="block mt-1 w-full input100" id="password" type="password" name="password" 
                         required required autocomplete="new-password" />
                         <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Confirm Password                            
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <x-input class="block mt-1 w-full input100" id="password" type="password" name="password_confirmation" 
                         required required autocomplete="new-password" />
                         <span class="focus-input100"></span>
                    </div>
                    {{-- <div class="p-t-13 p-b-9">

                        <span class="txt1">
                            Password
                        </span>

                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <x-input id="password" class="block mt-1 w-full input100" type="password" name="password"
                         required autocomplete="current-password" />

                        <span class="focus-input100"></span>
                    </div> --}}
    
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <div class="w-full text-center p-t-35">
                        <span class="txt2">
                            Not a member?
                        </span>

                        <a href="sign_up.html" class="txt2 bo1">
                            Sign up now
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
