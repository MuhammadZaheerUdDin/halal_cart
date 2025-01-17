<div>
    <!-- Hero Section -->
    <div id="overlay"></div>
    <section class="hero-service-wrap hero-section-wrap hero-overview-wrap hero-how-we-do-wrap">
      <div class="hero-section-content-wrap">
          <div class="custom-container">
              <div class="hero-section-content text-center">
                  <h1 class="section-title fade-in fnt-cl">Top-Quality Zabiha Halal Meat Delivery Online</h1>
              </div>
          </div>
      </div>
    </section>

    <section class="service-area">
        <div class="container py-5">
            <div class="row">
                <!-- Filter Sidebar -->
                <div class="col-md-3">
                    <div class="filter-section">
                        <button class="filter-button" id="filterButton">
                            <span>Filter</span>
                            <span class="filter-icon">
                              <!-- Icon as SVG -->
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M10 18h4v-2h-4v2zm-7-5h18v-2H3v2zm3-7v2h12V6H6z"/>
                              </svg>
                            </span>
                          </button>
                          <!-- Modal -->
                          {{-- <div class="modal" id="filterModal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="fnt-16">Halal Boneless Meat</span>
                                    <span class="close-button" id="closeModal">&times;</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="image-gallery">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="thumbnail" onclick="changeImage('meat-small1.jpg')">
                                                        <img src="{{ asset('assets/imgs/p17-300x300.jpg') }}" alt="Thumbnail 1">
                                                        <img src="{{ asset('assets/imgs/meet-logo.png') }}" alt="Client Logo" width="30%" />
                                                    </div>
                                                      <div class="thumbnail" onclick="changeImage('meat-small2.jpg')">
                                                        <img src="assets/imgs/p17-300x300.jpg" alt="Thumbnail 2">
                                                      </div>
                                                      <div class="thumbnail" onclick="changeImage('meat-small3.jpg')">
                                                        <img src="assets/imgs/p17-300x300.jpg" alt="Thumbnail 3">
                                                      </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="main-image">
                                                        <img id="mainImg" src="assets/imgs/p17-300x300.jpg" alt="Halal Boneless Meat">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Product Info -->
                                        <div class="product-info" align="left">
                                          <h1>Halal Boneless Meat</h1>
                                          <div class="rating">★★★★☆ <span class="text-black" style="font-size:14px;">4 Reviews</span></div>
                                          <div class="price">$17.28 <span>64% Off</span></div><hr>
                                          <div class="weight-options">
                                            <p>Weight</p>
                                            <button onclick="selectWeight(this)">1lb</button>
                                            <button onclick="selectWeight(this)">2lbs</button>
                                            <button onclick="selectWeight(this)">3lbs</button>
                                            <button onclick="selectWeight(this)">4lbs</button>
                                          </div>
                                          <div class="description">
                                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nibh diam, blandit vel consequat nec, ultrices et ipsum. Nulla varius magna a consequat pulvinar. 
                                          </div>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <div class="quantity">
                                                    <button onclick="updateQuantity(-1)">-</button>
                                                    <input id="quantity" type="text" value="5">
                                                    <button onclick="updateQuantity(1)">+</button>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <button class="add-to-cart">Add to Cart <i class="fa-solid fa-bag-shopping"></i></button>
                                              </div>
                                              <div class="col-md-2">
                                                  <div class="social-icons">
                                                    <i class="fa-regular fa-heart"></i>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div> --}}

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
                <div class="col-md-9">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <label for="sort" class="form-label">Sort by:</label>
                            <select id="sort" class="form-select d-inline w-auto">
                                <option value="latest">Latest</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                            </select>
                        </div>
                        <div>{{ $products->count() }} Results Found</div>
                    </div>
                    
                    <div class="row g-4">
                        <!-- Product Card -->
                        @foreach($products as $product)
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="product-image">
                                    <a href="{{ route('products.show', $product->id) }}" class="over-layer"><i class="fa"></i></a>
                                </div>
                                <div class="post-content">
                                    <p class="product-title">{{ $product->name }} | {{ $product->variants[0]->variant_value ?? '1lbs' }}</p>
                                    {{-- <button class="filter-button" wire:click="">
                                        Add To Cart
                                    </button> --}}
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded" 
                                    wire:click="$dispatch('openAddToCartModal', [{{ $product->id }}])">
                                        Add to Cart Emit
                                    </button>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="product-price">${{ number_format($product->price, 2) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="stars">
                                                {{ str_repeat('★', $product->rating) }}
                                                {{ str_repeat('☆', 5 - $product->rating) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(($loop->iteration % 3) == 0)
                            <div class="w-100"></div>
                        @endif
                    @endforeach
                    <livewire:add-to-cart-modal-component />

                        {{-- <div class="col-md-4">
                            <div class="post-slide">
                              <div class="post-img">
                                <img src="{{ asset('assets/imgs/p17-300x300.jpg') }}" alt="Aged Whole" class="product-image">
                                <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                              </div>
                              <div class="post-content">
                                <p class="product-title">Amish Whole Chicken | Approx. 2lb-3lb Chicken |...</p>
                                <div class="row">
                                    <div class="col-md-6"><p class="product-price">$120.00</p></div>
                                    <div class="col-md-6"><div class="stars">★★★★★</div></div>
                                </div>
                              </div>
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="post-slide">
                              <div class="post-img">
                                <img src="{{ asset('assets/imgs/p17-300x300.jpg')}}" alt="Aged Whole" class="product-image">
                                <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                              </div>
                              <div class="post-content">
                                <p class="product-title">Amish Whole Chicken | Approx. 2lb-3lb Chicken |...</p>
                                <div class="row">
                                    <div class="col-md-6"><p class="product-price">$120.00</p></div>
                                    <div class="col-md-6"><div class="stars">★★★★★</div></div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="post-slide">
                              <div class="post-img">
                                <img src="assets/imgs/p17-300x300.jpg" alt="Aged Whole" class="product-image">
                                <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                              </div>
                              <div class="post-content">
                                <p class="product-title">Amish Whole Chicken | Approx. 2lb-3lb Chicken |...</p>
                                <div class="row">
                                    <div class="col-md-6"><p class="product-price">$120.00</p></div>
                                    <div class="col-md-6"><div class="stars">★★★★★</div></div>
                                </div>
                              </div>
                            </div>
                        </div> --}}
                        <!-- Add more cards as needed -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>