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
              <div class="tabs">
                <button class="tab-button @if($status=='all') active @endif" wire:click="showTab('all')">All</button>
                <button class="tab-button @if($status=='paid') active @endif" wire:click="showTab('paid')">Pending</button>
                <button class="tab-button @if($status=='processing') active @endif" wire:click="showTab('processing')">Processing</button>
                <button class="tab-button @if($status=='shipped') active @endif" wire:click="showTab('shipped')">Shipped</button>
                {{-- <button class="tab-button @if($status=='review') active @endif" wire:click="showTab('review')">To Review</button> --}}
                <button class="tab-button @if($status=='completed') active @endif" wire:click="showTab('completed')">Completed</button>
              </div>
              @if(!empty($product_orders[0]))
                <!-- All Orders Tab -->
                <div class="order-list" id="all">
                  @foreach ($product_orders as $product_order)
                    @foreach ($product_order->orderProducts as $order)
                      <a class="order-item">
                        {{-- <a class="order-item" href="cancelation.html"> --}}
                          <div class="order-details">
                          <img src="{{ asset('storage/'.$order->product->image) }}">
                          <div class="details">
                            <p><strong>Fresh Boneless Meat</strong></p>
                            <p>Rs. {{ $order->price }}</p>
                            <p>Qty: {{ $order->quantity }}</p>
                          </div>
                        </div>
                        <div class="status completed">@if(!empty($product_order->status)) {{ $order->status }} @endif</div>
                      </a>
                    @endforeach
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
