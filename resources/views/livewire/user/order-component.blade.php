<div>

    <!-- Hero Section -->
    <section class="hero-service-wrap hero-section-wrap hero-overview-wrap hero-how-we-do-wrap">
      <div class="hero-section-content-wrap">
          <div class="custom-container">
              <div class="hero-section-content text-center">
                  <h1 class="section-title fade-in fnt-cl">Orders</h1>
              </div>
          </div>
      </div>
  </section>

        <!-- 3d sec -->


                  <!-- Product Grid -->
                    {{-- <div class="col-md-9 col-lg-9 col-xl-9 col-sm-12 col-xs-12">
                        @foreach ($product_orders as $order)
                            <div class="row g-4">
                                <!-- Product Card -->
                                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="post-slide">
                                        <div class="post-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="product-title">{{ $order->product->name }} | {{ $order->variant->variant_name }}  {{ $order->variant->value }}</p>
                                                    <p class="product-price">{{"Price: ".$order->price }} / {{ "Quantity :".$order->quantity }}
                                                    </p></div>
                                            </div>
                                        </div>
                                        <div class="post-img" style="width:200px; height:100px">
                                            <img src="{{ asset('storage/'.$order->product->image) }}"  class="checkout-img">
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more cards as needed -->
                            </div>
                        @endforeach
                    </div> --}}
    <!-- 3d sec -->
    <section class="how-it-works py-5 bg-light">
      <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center text-lg-start">
          <h2 class="text-uppercase text-dark text-center">Orders</h2>
          <div class="orders-container">
            <div class="d-flex justify-content-between mb-4">
              <div>
                  <label for="sort" class="form-label">Sort by:</label>
                  <input type="date" wire:model="selected_date" class="form-control">
                  {{-- <select id="sort" class="form-select d-inline w-auto">
                      <option value="latest">Latest</option>
                      <option value="price-low">Price: Low to High</option>
                      <option value="price-high">Price: High to Low</option>
                  </select> --}}
              </div>
              <div>{{ $product_orders->count() }} Results Found</div>
          </div>

              <div class="tabs">
                <button class="tab-button @if($status=='all') active @endif" wire:click="showTab('all')">All</button>
                <button class="tab-button @if($status=='paid') active @endif" wire:click="showTab('paid')">Pending</button>
                <button class="tab-button @if($status=='processing') active @endif" wire:click="showTab('processing')">Processing</button>
                <button class="tab-button @if($status=='shipped') active @endif" wire:click="showTab('shipped')">Shipped</button>
                {{-- <button class="tab-button @if($status=='review') active @endif" wire:click="showTab('review')">To Review</button> --}}
                <button class="tab-button @if($status=='completed') active @endif" wire:click="showTab('completed')">Completed</button>
                <button class="tab-button @if($status=='cancelled') active @endif" wire:click="showTab('cancelled')">Cancelled</button>

              </div>
              @if(!empty($product_orders[0]))
                <!-- All Orders Tab -->
                <div class="order-list  col-md-7" id="all">
                  @foreach ($product_orders as $product_order)
                    <div class="order-container orders">
                      <div class="order-header">
                        <h1>Order # <br><span>{{ $product_order->order_number }}</span></h1>
                        <h1>Date : <br><span>{{ $product_order->created_at->format('d-m-Y') }} </span></h1>
                        <div class="status completed">
                          @if(!empty($product_order->status)) {{ $product_order->status }} @endif
                        </div>
                      </div>
                      <div  style="display: block; width: 100%; clear: both;text-align:center">
                        <button class="btn viw-btn0" wire:click="toggleVisibility({{ $product_order->id }})">Details</button>
                      </div>
                      <div class="col-md-12" style="display: flex">
                        @if(!empty(!empty($visibleProducts[$product_order->id])))
                          <div class="col-md-8">
                              @foreach ($product_order->orderProducts as $order)
                                <a class="order-item col-md-8">
                                    <div class="order-details-40 order-body" style="color: #333;"> 
                                      <img src="{{ asset('storage/'.$order->product->image) }}" loading="lazy" style=" border-radius:6px;">
                                        <p><strong>{{$order->product->name}}</strong></p>
                                        <p>Qty:{{ $order->quantity }} / ${{ $order->price }}</p>
                                    </div>
                                </a>
                              @endforeach
                          </div>
                          <div class="col-md-4" style="text-align: center;">
                            <a class="order-item " >
                              <div class="order-details-40 " style="color: #333;"> 
                                  <p><b>Total AMount: ${{ $product_order->total }}</b></p>
                              </div>
                            </a>
                          </div>
                        @endif
                      </div>
                    </div>
                  @endforeach
                </div>
              @else
                <!-- To Review Tab -->
                <div class="order-list"  style="">
                  <p>No orders to review.</p>
                </div>
              @endempty
          </div>
        </div>
      </div>
  </section>
  

</div>
