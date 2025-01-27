<x-guest-layout>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/imgs/bg-01.png');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-6 p-b-3" style="width:500px !important">
                <form class="login100-form validate-form flex-sb flex-w"  method="POST" action="{{ route('admin.login') }}">
                        @csrf
            
                    <span class="login100-form-title p-b-20">
                        <img src="{{ asset('assets/imgs/meet-logo.png') }}" class="wid-img">
                    </span>
                    
                    <div class="col-md-12">
                    <x-validation-errors class="mb-4" />
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
