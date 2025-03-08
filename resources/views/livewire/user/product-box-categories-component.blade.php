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

      <!-- Product Card -->
      <style type="text/css">
       
        .product-card {
              position: relative;
              border-radius: 8px;
              overflow: hidden;
              transition: transform 0.3s;
              padding: 0px;
            }
        
            .product-card:hover {
              transform: translateY(-5px);
            }
        
            
        
            
            .product-card__image--secondary {
              position: absolute;
              top: 0;
              left: 0;
              opacity: 0;
            }
        
            .product-card:hover .product-card__image--primary {
              opacity: 0;
            }
        
            .product-card:hover .product-card__image--secondary {
              opacity: 1;
            }
        
            .product-card__info {
              padding: 16px;
              text-align: left;
            }
            .product-card_new {
              padding: 16px;
            }
            .product-title {
              font-size: 18px;
              font-weight: bold;
              margin: 8px 0;
              color: #333;
              text-decoration: none;
            }
        
            .custom-description {
              font-size: 14px;
              color: #666;
              margin: 8px 0;
            }
            .text-lft {
                text-align: left;
                font-size: 14px;
                color: #666;
                margin: 8px 0;
            }
            .price {
              font-size: 18px;
              font-weight: bold;
              color: #588D4F;
            }
        
            .button {
              padding: 10px 20px;
              margin-top: 12px;
              font-size: 14px;
              color: #fff;
              background-color: #7f0000;
              border: none;
              border-radius: 4px;
              width: auto;
              cursor: pointer;
              text-decoration: none;
              transition: background-color 0.3s;
          }
          .button-bord {
              display: inline-block;
              padding: 10px 20px;
              margin-top: 12px;
              font-size: 14px;
              color: #7f0000;
              border: 2px solid #7f0000;
              border-radius: 4px;
              width: auto;
              cursor: pointer;
              text-decoration: none;
              transition: background-color 0.3s;
          }
        
            .button:hover {
              background-color: #ffd700;
              color: #fff;
            }
            .button-bord:hover {
              color: #fff;
              background-color: #7f0000;
            }
        .filter-button .filter-icon svg {
          width: 20px;
          height: 20px;
          fill: #fff;
        }
        
        .filter-button:hover {
          background-color: #0056b3;
        }
        
          
            
            
            
        /* .s-h {
          display: none; 
        } 
        */
        /* .s-h.active {
          display: block;
          opacity: 1;
        } */
    </style>

    <livewire:add-to-cart-modal-component />                

    <section class="service-area">
      <div class="container py-5">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row g-4" style="justify-content: flex-start !important;">
            @foreach ($products as $product)
              <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 services s-h" style="flex: none !important;">
                <div class="product-card" >
                  <div class="product-hide{{ $product->id }}" style="{{ isset($visibleProducts[$product->id]) && $visibleProducts[$product->id] ? 'display: none;' : '' }}"
                    >
                      <div class="product-card__figure">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="Halal Box - Best of Boxed Halal"class="product-card__image product-card__image--primary">
                        <img src="{{ asset('storage/'.$product->image) }}"alt="Halal Box - Best of Boxed Halal" 
                            class="product-card__image product-card__image--secondary">
                      </div>
                      <div class="product-card__info">
                        {{-- <div class="stars1">★★★★ <span style="font-size: 12px; color: black;"> (4.5)</span></div> --}}
                        <a href="/products/best-of-boxed-halal" class="product-title">{{ $product->name }}</a>
                        <p class="custom-description">{{ $product->description }}</p>
                        <div class="row">
                          <nav>
                            <ul>
                              <li class="lok-insd mb-2" >
                                <a  wire:click="$dispatch('openAddToCartModal', [{{ $product->id }}])" style="cursor:pointer" class="fnt-clr">ADD TO CART <span>- ${{ $product->variants[0]->price }}</span></a></li>
                              <li class="navContact lok-insd-new" data-target=".contact"  wire:click="toggleVisibility({{ $product->id }})">LOOK INSIDE THE BOX</li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                  </div>
                  <div class="product-card_new{{ $product->id }}" style="{{ isset($visibleProducts[$product->id]) && $visibleProducts[$product->id] ? '' : 'display: none;' }}"
                    >
                    <a href="/products/boxed-halal-wagyu-box" class="product-title h6 " data-instant=""><span>Boxed Halal - Wagyu Box</span></a>
                    <p class="text-lft">Includes:</p>
                    <div class="ro-stl">
                        <ul>
                          @foreach(explode(',', $product->ingredients) as $item)
                          <li>{{ trim($item) }}</li>
                          @endforeach
                        </ul>
                    </div>
                    <div class="price-info mt-2">
                        {{-- <a href="" class="more-info">MORE INFO</a> --}}
                        <div>
                            <span class="current-price">${{ $product->price }}</span>
                            {{-- <span class="original-price">$270.00</span> --}}
                        </div>
                    </div>
                    <div class="row mt-5">
                      <nav>
                          <ul>
                              {{-- <li class="lok-insd mb-2"><a wire:click="$dispatch('openAddToCartModal', [63])" class="fnt-clr">ADD TO CART <span>- $149.99</span></a></li> --}}
                              <li class="navContact lok-insd-new back-btn" wire:click="toggleVisibility({{ $product->id }})" data-target=".services">BACK</li>
                          </ul>
                      </nav>
                      <p class="text-center">100% Satisfaction Guaranteed</p>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
            @if($currentPage != $lastPage)
            <div class="col-md-12 mt-5 text-center">
              <button wire:click="loadMore" class="btn viw-btn">
                  Load More
              </button>
            </div>
          @endif

          </div>
      </div>
    </section>

</div>