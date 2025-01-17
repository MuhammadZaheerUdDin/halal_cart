<div>
    @if($isOpen)
    <div class="modal" style="display: flex">
        <div class="modal-content">
            <div class="modal-header">
                <span class="fnt-16">{{ $product->name }}</span>
                <span class="close-button" id="closeModal" wire:click="closeModal">&times;</span>
            </div>
            <div class="row">
                    @if (session()->has('error'))
                        <div class=" text-red p-2 mb-4" style="background-color:red">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="bg-green-500 text-black p-2 mb-1" style="background-color: green;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(empty(Auth::user()->id))
                        <div class="col-md-12" style="">
                            <div class="col-md-2">
                                <a class="bg-blue-500 text-white px-4 py-2 rounded col-md" href="{{ url('login') }}">
                                    Login
                                </a>
                            </div>
                        </div>
                    @endif

                <div class="col-md-6">
                            
                    <div class="image-gallery">
                        <div class="d-flex">

                            <div class="col-md-3 col-sm-3 col-4">
                                <div class="thumbnail" onclick="changeImage('{{ asset('storage/' . $product->image) }}')">
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="Thumbnail 1">
                                </div>
                                @if($product->images)
                                    @foreach ($product->images as $img)
                                        <div  class="thumbnail" onclick="changeImage('{{ asset('storage/' . $img->image_path) }}')">
                                            <div wire:replace>
                                                <img src="{{ asset('storage/'.$img->image_path) }}" alt="Thumbnail 1">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-9 col-sm-9 col-8">
                                <div class="main-image">
                                    {{-- <img id="mainImg" src="assets/imgs/p17-300x300.jpg" alt="Halal Boneless Meat"> --}}
                                    <img id="mainImg" src="{{ asset('storage/'.$product->image) }}" alt="Halal Boneless Meat" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Product Info -->
                    <div class="product-info" align="left">
                      <h1>{{ $product->name }}</h1>
                      {{-- <div class="rating">★★★★☆ <span class="text-black" style="font-size:14px;">4 Reviews</span></div> --}}
                      <div class="price">${{ $product->price }} 
                        {{-- <span>64% Off</span> --}}
                    </div><hr>
                      <div class="weight-options">
                        <p>Weight</p>
                        @foreach ($product->variants as $variant)
                            {{-- <button onclick="selectWeight($variant)"> --}}
                            <button 
                                wire:click="selectedVariant('{{ $variant->id }}')" 
                                class="{{ $selected_variant == $variant->id ? 'active' : '' }}">
                                {{ $variant->variant_value }}{{ $variant->variant_name }}
                            </button>
                        @endforeach
                      </div>
                      <div class="description">
                        {{-- Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nibh diam, blandit vel consequat nec, ultrices et ipsum. Nulla varius magna a consequat pulvinar.  --}}
                        {{ $product->description }}
                      </div>
                      <div class="row">
                          <div class="col-md-4 col-sm-4">
                              <div class="quantity">
                                <button wire:click="updateQuantity(-1)">-</button>
                                <input id="quantity" type="text" value="{{ $quantity }}" disabled>
                                <button wire:click="updateQuantity(1)">+</button>
                              </div>
                          </div>
                          <div class="col-md-5 col-sm-5 mt-2">
                              <button class="add-to-cart" wire:click="addToCart">Add to Cart <i class="fa-solid fa-bag-shopping"></i></button>
                          </div>
                          <div class="col-md-3 col-sm-3 text-center mt-2 payout-btn">
                            <a href="payout" class="text-dark" id="">Payout</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    @endif
</div>