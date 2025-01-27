<div>
    <!-- Hero Section -->
        <section class="hero-empowerment-area">
            <div class="custom-container">
                <div class="custom-row align-items-center">
                    <div class="hero-empowerment-left-content">
                        <h3 class="section-title fade-in">Making Healthy</h3>
                        <h1 class="section-title fade-in">Eating Effortless</h1>
                        <div class="btns-group d-flex col-md-8">
                            <div class="col-md-4 ">
                                <div class="d-flex">
                                    <div class="col-md-2"><img class="desktop fade-in" src="assets/imgs/check.png" alt="Empowerment"></div>
                                    <div class="col-md-10"><p>Organic</p></div>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="d-flex">
                                    <div class="col-md-2"><img class="desktop fade-in" src="assets/imgs/check.png" alt="Empowerment"></div>
                                    <div class="col-md-10"><p>Halal</p></div>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="d-flex">
                                    <div class="col-md-2"><img class="desktop fade-in" src="assets/imgs/check.png" alt="Empowerment"></div>
                                    <div class="col-md-10"><p>Eat Clean</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="btns-group d-flex">
                            <a href="#" class="theme-btn">Get Offer <i class="iconoir-arrow-up-right"></i></a>
                        </div>
                    </div>

                    <div class="hero-empowerment-right-content">
                        <div class="top-content">
                            <img class="desktop fade-in" src="assets/imgs/bg1-1.png" alt="Empowerment">
                            <img class="mobile" src="assets/imgs/bg1.png" alt="Empowerment">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- 2nd sec -->
        <section class="bg-blue">
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <img class="desktop fade-in chck-tick" src="assets/imgs/p-img.png"><p class="mb-0 mrg-lft">Handpicked for exceptional quality and freshness</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <img class="desktop fade-in chck-tick" src="assets/imgs/p-img.png"><p class="mb-0 mrg-lft">Expertly cut and prepared for your convenience</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <img class="desktop fade-in chck-tick" src="assets/imgs/p-img.png"><p class="mb-0 mrg-lft">Delivered to your doorstep with care and efficiency</p>
                        </div>
                    </div>    
                </div>
            </div>
        </section>
    <!-- End 2nd sec -->
    <!--  3rd sec -->
        <section class="service-area">
            <div class="custom-container">
                <div class="content-header container text-center py-4">
                    <h2 class="text-justify">
                        Build your plate with<br>
                        <span class="d-block" style="font-size: 35px; font-family: 'Brush Script MT', cursive; color: #ffd700;">protein</span>
                    </h2>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="button left">
                            <button id="prevBtn" class=" nav-btn left-btn">
                                &larr;
                            </button>
                        </div>
                        <div class="button right">
                            <button id="nextBtn" class=" nav-btn1 right-btn">
                                &rarr;
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Carousel Container -->
                @if(!empty($header_menu_items))
                    <div class="carousel">
                        <div class="carousel-track-container">
                            <ul class="carousel-track">
                                <!-- Individual Slides -->
                                @foreach ($header_menu_items as $header)
                                    <li class="carousel-slide">
                                        <div class="item">
                                            <a href="{{ route('categories.show', Crypt::encrypt($header['slug'])) }}">
                                            <img src="assets/imgs/remit-continental.png" alt="Poultry" loading="lazy">
                                            <p>{{ $header['name'] }}</p>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                @endempty

            </div>
        </section>
    <!-- End 3rd sec -->

    <!-- product -->
        <section class="service-area">
            <div class="custom-container">
                <div class="content-headern">
                    <h2 style="font-size: 35px;">Our best <span style="font-size: 35px; font-family: 'Brush Script MT', cursive; color: #ffd700; ">sellers</span></h2>
                </div>
                @if(!empty($products[0]))
                    <div class="row g-4">
                        <!-- Product Card -->
                        @foreach ($products[0] as $product)
                            <div class="col-md-4">
                                <div class="post-slide">
                                    <div class="post-img  div-cusor" wire:click="$dispatch('openAddToCartModal', [{{ $product->id }}])">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Aged Whole" class="product-image">
                                        <a  class="over-layer"><i class="fa fa-link">Add To Cart</i></a>
                                    </div>
                                    <div class="post-content div-cusor">
                                        <p class="product-title">{{ $product->name }} | Approx. 
                                            @if(!empty($product->variants[0]))
                                                {{  $product->variants[0]->variant_value }}
                                                {{  $product->variants[0]->variant_name }}
                                            -  
                                                @if($product->variants[0]->variant_value != $product->latestVariant->variant_value)
                                                    {{  $product->latestVariant->variant_value }}{{  $product->latestVariant->variant_name }}
                                                @endif
                                            @endif
                                            |...
                                        </p>
                                        <div class="row" >
                                            <div class="col-md-6"><p class="product-price">${{ number_format($product->price, 2)  }}</p></div>
                                            <div class="col-md-6"><div class="stars">★★★★★</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Add more cards as needed -->
                    </div>
                @endif
                @if(!empty($products[1]))
                    <div class="row g-4">
                        <!-- Product Card -->
                        @foreach ($products[0] as $product)
                        <div class="col-md-4">
                            <div class="post-slide">
                                <div class="post-img  div-cusor" wire:click="$dispatch('openAddToCartModal', [{{ $product->id }}])">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Aged Whole" class="product-image">
                                    <a  class="over-layer"><i class="fa fa-link">Add To Cart</i></a>
                                </div>
                                <div class="post-content div-cusor">
                                    <p class="product-title">{{ $product->name }} | Approx. 
                                        @if(!empty($product->variants[0]))
                                            {{  $product->variants[0]->variant_value }}
                                            {{  $product->variants[0]->variant_name }}
                                        -  
                                            @if($product->variants[0]->variant_value != $product->latestVariant->variant_value)
                                                {{  $product->latestVariant->variant_value }}{{  $product->latestVariant->variant_name }}
                                            @endif
                                        @endif
                                        |...
                                    </p>
                                    <div class="row" >
                                        <div class="col-md-6"><p class="product-price">${{ number_format($product->price, 2)  }}</p></div>
                                        <div class="col-md-6"><div class="stars">★★★★★</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <!-- Add more cards as needed -->
                    </div>
                @endif
                <div class="col-md-12 mt-5 text-center">
                    <button class="btn viw-btn">View More</button>
                </div>

            </div>
        </section>
        <livewire:add-to-cart-modal-component />

    <!-- How We Do -->
        <section class="how-it-works py-5 bg-light">
            <div class="container">
            <div class="row align-items-center">
                <!-- Text Section -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="mb-4">How it <span class="text-warning" style="font-size: 45px; font-family: 'Brush Script MT', cursive;">works</span></h2>
                <div class="row mb-4">
                    <div class="row align-items-center p-3">
                    <div class="col-12 col-md-auto mb-3 mb-md-0 text-center">
                        <img src="assets/imgs/heart.png" alt="Choose Icon" class="img-fluid" width="70">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Choose What You Like</h5>
                        <p class="text-muted mb-0">
                        Pick from a wide range of options to support your wellness
                        goals—including meals that are keto, low-carb, and vegetarian.
                        </p>
                    </div>
                    </div>
                    <div class="row align-items-center p-3">
                    <div class="col-12 col-md-auto mb-3 mb-md-0 text-center">
                        <img src="assets/imgs/heart.png" alt="Choose Icon" class="img-fluid" width="70">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Choose What You Like</h5>
                        <p class="text-muted mb-0">
                        Pick from a wide range of options to support your wellness
                        goals—including meals that are keto, low-carb, and vegetarian.
                        </p>
                    </div>
                    </div>
                    <div class="row align-items-center p-3">
                    <div class="col-12 col-md-auto mb-3 mb-md-0 text-center">
                        <img src="assets/imgs/heart.png" alt="Choose Icon" class="img-fluid" width="70">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Choose What You Like</h5>
                        <p class="text-muted mb-0">
                        Pick from a wide range of options to support your wellness
                        goals—including meals that are keto, low-carb, and vegetarian.
                        </p>
                    </div>
                    </div>
                </div>
                <button class="btn btn-danger btn-lg">Get Started</button>
                </div>
                <!-- Image Section -->
                <div class="col-lg-6 text-center">
                    <div class="text-center animation-slide-left how-we-do-bg slide-left">
                    <img src="assets/imgs/Element.png" alt="Delicious Food" class="rounded" width="10%">
                    </div>
                <img src="assets/imgs/Mask-group.png" alt="Delicious Food" class="img-fluid rounded ">
                </div>
            </div>
            </div>
        </section>
    <!-- sec test -->
        <section class="testimonial-section">
            <div class="container">
                <div class="content-header">
                    <h2 style="text-align: justify;">What People Say about Our<br>
                    <span style="font-size: 35px; font-family: 'Brush Script MT', cursive; color: #ffd700; ">Services</span></h2>
                </div>
                <div id="news-slider" class="owl-carousel mt-0">
                    <div class="post-slide testimonial-card">
                    <div class="quote">&#8220;</div>
                        <div class="stars1">
                            &#9733;&#9733;&#9733;&#9733;&#9733;
                        </div>
                        <p>Donec ac odio tempor orci dapibus ultrices in. Facilisis magna etiam tempor orci eu lobortis.</p>
                        <h5>Leslie Johnson</h5>
                        <p class="rating">Great Service</p>
                    </div>

                    <div class="post-slide testimonial-card">
                    <div class="quote">&#8220;</div>
                        <div class="stars1">
                            &#9733;&#9733;&#9733;&#9733;&#9733;
                        </div>
                        <p>Donec ac odio tempor orci dapibus ultrices in. Facilisis magna etiam tempor orci eu lobortis.</p>
                        <h5>Leslie Johnson</h5>
                        <p class="rating">Great Service</p>
                        
                    </div>

                    <div class="post-slide testimonial-card">
                    <div class="quote">&#8220;</div>
                        <div class="stars1">
                            &#9733;&#9733;&#9733;&#9733;&#9733;
                        </div>
                        <p>Donec ac odio tempor orci dapibus ultrices in. Facilisis magna etiam tempor orci eu lobortis.</p>
                        <h5>Leslie Johnson</h5>
                        <p class="rating">Great Service</p>
                    </div>
                </div>
                </div>
        </section>
    <!-- img slid -->
        <section class="how-it-works py-5 bg-light">
            <div class="slider">
            <div class="list">
                <div class="item slider-section">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 slider-content1" style="flo">
                        <h2><strong>Cooked <span style="color: red;">meat</span></strong></h2>
                        <p>
                            We&#39;re proud to be rated among the best for baby goat meat in town. Our tender, high-quality
                            meat comes from premium Boer goats, sourced locally from Amish and nearby farmers.
                        </p>
                        <p><strong>New sales and discounts are added all the time.</strong></p>
                        <a href="#" class="btn btn-danger">Buy now</a>
                    </div>
                </div>
                <div class="item slider-section">
                    <div class="col-md-6 slider-content" style="flo">
                        <h2><strong>Cooked <span style="color: red;">meat</span></strong></h2>
                        <p>
                            We&#39;re proud to be rated among the best for baby goat meat in town. Our tender, high-quality
                            meat comes from premium Boer goats, sourced locally from Amish and nearby farmers.
                        </p>
                        <p><strong>New sales and discounts are added all the time.</strong></p>
                        <a href="#" class="btn btn-danger">Buy now</a>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="item slider-section">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 slider-content1" style="flo">
                        <h2><strong>Cooked <span style="color: red;">meat</span></strong></h2>
                        <p>
                            We&#39;re proud to be rated among the best for baby goat meat in town. Our tender, high-quality
                            meat comes from premium Boer goats, sourced locally from Amish and nearby farmers.
                        </p>
                        <p><strong>New sales and discounts are added all the time.</strong></p>
                        <a href="#" class="btn btn-danger">Buy now</a>
                    </div>
                </div>
                <div class="item slider-section">
                    <div class="col-md-6 slider-content" style="flo">
                        <h2><strong>Cooked <span style="color: red;">meat</span></strong></h2>
                        <p>
                            We&#39;re proud to be rated among the best for baby goat meat in town. Our tender, high-quality
                            meat comes from premium Boer goats, sourced locally from Amish and nearby farmers.
                        </p>
                        <p><strong>New sales and discounts are added all the time.</strong></p>
                        <a href="#" class="btn btn-danger">Buy now</a>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
            <!--button prev and next-->
            <div class="buttons">
                <button id="prev"><</button>
            <button id="next">></button>
            </div>
            <!--Dots (if 5 items => 5 dots)-->
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li> 
            </ul>
            </div>
        </section>
</div>
