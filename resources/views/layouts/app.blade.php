<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- ========== Start Fonts Style ========== -->
            {{-- <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
            <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
            <link rel="preconnect" href="https://fonts.googleapis.com/">
            <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <!-- End Font Style -->

        <!-- ========== Start Stylesheet ========== -->
            <link rel="stylesheet" href="../../../cdn.jsdelivr.net/gh/iconoir-icons/iconoir%40main/css/iconoir.css">
            <link rel="stylesheet" href="../../../maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
            {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> --}}
            <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    
            <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}"/>
            {{-- <link rel="stylesheet" href="./assets/css/style.css"> --}}
            <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('css/custom_user.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
            <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css') }}"/>
        <!-- ========== End Stylesheet ========== -->
            
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @vite(['resources/js/app.js'])
        <script src="{{ asset('js/custom.js') }}" defer></script>
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript"></script>
        <script src="{{ asset('js/custom_user.js') }}" ></script>
        <!-- Styles -->
        @livewireStyles
    </head>
    {{-- <body class="font-sans antialiased"> --}}
    <body class="" >
        <script src="https://js.stripe.com/v3/"></script>
        {{-- <script type="text/javascript"></script> --}}

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        {{-- <x-banner />  --}}
        {{-- <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div> --}}
        <main class="main-page homepage">
            <!-- Header Bar -->
            <div class="header-bar">
                <div class="custom-container">
                    <div class="header-bar-body d-flex align-items-center justify-content-between">
                        
                        <div class="right col-md-12">
                            <p class="text-center" style="font-size: 17px; font-family: 'Brush Script MT', cursive;">
                               SSi People Website Design (copy)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>    
    <!-- Header -->
    <div id="overlay"></div>
        {{-- <livewire:cart-component /> --}}
        @include('header')
        {{ $slot }}
        <!-- Footer -->
        <footer class="footer-area">
            <img src="assets/imgs/bg-shape-4.svg" alt="Shape" class="animation-slide-right bg-shape" />
            <div class="footer-bottom">
                <div class="custom-container">
                    <div class="custom-row">
                        <div class="footer-all-links-wrap justify-content-between d-flex">
                            <div class="footer-links">
                                <h2 class="ft-clr">Get premium meat delivered direct <span style="font-size: 35px; font-family: 'Brush Script MT', cursive; color : #ffd700;">to you</span>.</h2>
                                <div class="email-input">
                                    <input type="email" placeholder="Enter Email Address" />
                                    <button type="submit">
                                        <span>&#8594;</span> <!-- Arrow Icon -->
                                    </button>
                                </div>

                                <!-- Social Media Icons -->
                                <div class="social-icons">
                                    <a href="#" class="icon">
                                        <img src="{{ asset('assets/imgs/facebook.png') }}" alt="Facebook" />
                                    </a>
                                    <a href="#" class="icon">
                                        <img src="{{ asset('assets/imgs/youtube.png') }}" alt="YouTube" />
                                    </a>
                                    <a href="#" class="icon">
                                        <img src="{{ asset('assets/imgs/twitter.png') }}" alt="Twitter" />
                                    </a>
                                </div>
                            </div>
                            <div class="footer-links w-190">
                                <h3>Site map</h3>
                                <ul>
                                    <li><a href="blog.html">Poultry</a></li>
                                    <li><a href="about.html">Meat</a></li>
                                    <li><a href="partner.html">Meal Kits</a></li>
                                    <li><a href="career.html">Frozen Products</a></li>
                                    <li><a href="event.html">Health & Wellness</a></li>
                                    <li><a href="team.html">Drinks</a></li>
                                    <li><a href="team.html">About us</a></li>
                                </ul>
                            </div>
                            <div class="footer-links">
                                <h3>Help</h3>
                                <ul>
                                    <li><a href="case-studie.html">How it Works</a></li>
                                    <li><a href="pricing.html">FAQ</a></li>
                                    <li><a href="feature.html">Contact Us</a></li>
                                    <li><a href="overview.html">Refer a Friend</a></li>
                                </ul>
                            </div>
                            <div class="footer-links">
                                <h3>Legal</h3>
                                <ul>
                                    <li><a href="our-field-details.html">Privacy Policy</a></li>
                                    <li><a href="our-field-details.html">Terms of Service</a></li>
                                    <li><a href="our-field-details.html">Refund Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="custom-container">
                    <div class="custom-row d-flex align-items-center justify-content-between">
                        <ul class="social-links d-flex align-items-center">
                            <li><a href="#">
                                <i class="iconoir-dribbble"></i>
                            </a></li>
                            <li><a href="#">
                                <i class="iconoir-twitter"></i>
                            </a></li>
                            <li><a href="#">
                                <i class="iconoir-instagram"></i>
                            </a></li>
                            <li><a href="#">
                                <i class="iconoir-linkedin"></i>
                            </a></li>
                        </ul>
                        <div class="col-md-12">
                        <div class="row">
                                <div class="col-md-4">
                                    <p>Copyright@2024</p>
                                </div>
                                <div class="col-md-8">
                                    <img src="assets/imgs/Laysser 1 1.png" alt="Delicious Food" class="rounded" width="70%">
                                </div>
                            </div> 
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer -->

        {{-- </main> --}}
        @stack('modals')

        @livewireScripts
        {{-- @livewireScriptConfig --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </body>
</html>
