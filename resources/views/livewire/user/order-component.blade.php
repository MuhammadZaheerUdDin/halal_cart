<div>

    <section class="hero-service-wrap hero-section-wrap hero-overview-wrap hero-how-we-do-wrap">
        <div class="hero-section-content-wrap">
            <div class="custom-container">
                <div class="hero-section-content text-center">
                    <h1 class="section-title fade-in fnt-cl">Top-Quality Zabiha Halal Meat Delivery Online</h1>
                </div>
            </div>
        </div>
    </section>

        <!-- 3d sec -->
        <section class="service-area">
            <div class="container py-5">
                <div class="row">
                    <!-- Filter Sidebar -->
                    <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12 col-xs-12">
                        <div class="filter-section">
                            <button class="filter-button" >
                                <span>Filter</span>
                                <span class="filter-icon">
                                  <!-- Icon as SVG -->
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M10 18h4v-2h-4v2zm-7-5h18v-2H3v2zm3-7v2h12V6H6z"/>
                                  </svg>
                                </span>
                              </button>
    
                            <hr>
                            <div class="rating-section">
                              <h3>Rating</h3>
                              <div class="rating-option">
                                <input type="checkbox" id="rating-5" />
                                <label for="rating-5">
                                  <span class="stars">★★★★★ <span style="color: black;">5.0</span></span>
                                </label>
                              </div>
                              <div class="rating-option">
                                <input type="checkbox" id="rating-4" checked />
                                <label for="rating-4">
                                  <span class="stars">★★★★☆ <span style="color: black;">4.0 & up</span></span>
                                </label>
                              </div>
                              <div class="rating-option">
                                <input type="checkbox" id="rating-3" />
                                <label for="rating-3">
                                  <span class="stars">★★★☆☆ <span style="color: black;">3.0 & up</span></span>
                                </label>
                              </div>
                              <div class="rating-option">
                                <input type="checkbox" id="rating-2" />
                                <label for="rating-2">
                                  <span class="stars">★★☆☆☆ <span style="color: black;">2.0 & up</span></span>
                                </label>
                              </div>
                              <div class="rating-option">
                                <input type="checkbox" id="rating-1" />
                                <label for="rating-1">
                                  <span class="stars">★☆☆☆☆ <span style="color: black;">1.0 & up</span></span>
                                </label>
                              </div>
                            </div>
    
                        </div>
                    </div>
    
                    <!-- Product Grid -->
                    <div class="col-md-9 col-lg-9 col-xl-9 col-sm-12 col-xs-12">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <label for="sort" class="form-label">Sort by:</label>
                                <select id="sort" class="form-select d-inline w-auto">
                                    <option value="latest">Latest</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                </select>
                            </div>
                            <div>52 Results Found</div>
                        </div>
                        @foreach ($product_orders as $order)
                            <div class="row g-4">
                                <!-- Product Card -->
                                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="post-slide">
                                        <div class="post-img" style="width:200px; height:100px">
                                            <img src="{{ asset('storage/'.$order->product->image) }}"  class="checkout-img">
                                            <a href="#" class="over-layer" id="filterButton"><i class="fa">Add to Cart</i></a>
                                        </div>
                                        <div class="post-content">
                                            <p class="product-title">{{ $order->product->name }} | Approx. {{ $order->variant->variant_name }}  {{ $order->variant->value }} Chicken |...</p>
                                            <div class="row">
                                                <div class="col-md-6"><p class="product-price">{{"Price: ".$order->price }} / {{ "Quantity :".$order->quantity }}</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more cards as needed -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    

</div>
