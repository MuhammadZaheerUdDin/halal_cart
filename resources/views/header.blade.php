<header class="header-area">
    <div class="container">
        <div class="row">
            <div class="header-bar-body d-flex align-items-center justify-content-between">
                <!-- Left Section (Icons like Search) -->
                <div class="col-md-4 col-lg-4 col-sm-3 col-xs-3 d-flex justify-content-start">
                    <div class="nav-icons">
                        <a href="#"><i class="fas fa-search"></i></a>
                    </div>
                </div>

                <!-- Center Section (Logo) -->
                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-6 d-flex justify-content-end">
                    <a href="{{ url('/') }}" class="logo mt-1">
                        {{-- <img src="assets/imgs/meet-logo.png" alt="Client Logo" width="35%" /> --}}
                        <img src="{{ asset('assets/imgs/meet-logo.png') }}" alt="Client Logo" width="35%" />
                    </a>
                </div>

                <!-- Right Section (Icons like User, Cart) -->
                <div class="col-md-4 col-lg-4 col-sm-3 col-xs-3 d-flex justify-content-end">
                    <div class="nav-icons">
                        <i class="fas fa-user dropdown-toggle" id="userIcon" role="button"></i>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            @if(!empty(Auth::user()->id))
                                <x-responsive-nav-link href="{{ route('orders') }}">
                                    {{ __('Orders') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                
                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                                   @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                                @else
                                <x-responsive-nav-link href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </x-responsive-nav-link>    
                            @endif
                        </ul>
                        {{-- <a href="{{ route('cart') }}" id="openMenuBtn"><i class="fas fa-shopping-cart"></i></a> --}}
                        <livewire:cart-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-12 text-end">
                <button class="menu-toggle" style="float: inline-end;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <nav class="navbar-wrapper txt-nav">
            <button class="close-nav" id="closeNav">&times;</button>
            @livewire('user.header-menu')
        </nav>

    </div>
</header>
