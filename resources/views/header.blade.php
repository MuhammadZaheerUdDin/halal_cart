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
                        <a href="{{ url('/login') }}"><i class="fas fa-user"></i></a>
                        <a href="#" id="openMenuBtn"><i class="fas fa-shopping-cart"></i></a>
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
        <nav class="navbar-wrapper">
            <button class="close-nav" id="closeNav">&times;</button>
            @livewire('user.header-menu')
            {{-- <ul> --}}
                {{-- <li><a href="{{ route('categories.show', Crypt::encrypt("Poultry")) }}">Poultry</a></li>
                <li><a href="{{ route('categories.show', Crypt::encrypt("Meal_Kits")) }}">Meat Kits</a></li>
                <li><a href="{{ route('categories.show', Crypt::encrypt("Poultry")) }}">Frozen Products</a></li>
                <li><a href="{{ route('categories.show', Crypt::encrypt("Poultry")) }}">Health & Wellness</a></li>
                <li><a href="{{ route('categories.show', Crypt::encrypt("Poultry")) }}">Drinks</a></li>
                <li><a href="{{ route('categories.show', Crypt::encrypt("Poultry")) }}">Halal Box</a></li> --}}

            {{-- </ul> --}}
        </nav>

    </div>
</header>
