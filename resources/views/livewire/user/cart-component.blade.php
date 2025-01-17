{{-- <div id="menu">
    <div class="menu-header">
      <b>Shopping Card ( @if(!empty(Illuminate\Support\Facades\Auth::user()->id)) {{   $cart->sum('quantity')  }} @endif)</b>
      <button id="closeMenuBtn" class="close-btn">&times;</button>
    </div>
    <div class="aut-scrol">
        @if(!empty($cart) && !empty(Auth::user()->id))
            @foreach ($cart as $cart_item)
                <div class="menu-content item-section mt-2">
                    <img src="{{ asset('storage/'.$cart_item->product->image) }}">
                    <div class="item-details">
                        <h3>{{ $cart_item->product->name }}</h3>
                        <p>{{ $cart_item->quantity }} {{ $cart_item->variant->variant_name }} x <span class="price">{{ $cart_item->variant->price }}</span></p>
                    </div>
                    <button class="close-btn">&times;</button>
                </div>
            @endforeach            
        @endempty
    </div>
    <div class="cart-section">
        <div class="cart-header">
          <span> @if(!empty($cart) && !empty(Illuminate\Support\Facades\Auth::user()->id)) {{ $cart->sum('quantity') }} @endif Product</span>
          <span>@if(!empty(Illuminate\Support\Facades\Auth::user()->id)) {{  $cart->sum('total') }} @endif</span>
        </div>
        <button class="checkout-btn" onclick="window.location.href='{{ route('checkout') }}'">Checkout</button>
        <button class="go-to-cart-btn">Go To Cart</button>
    </div>
</div> --}}

<!-- Hero Section -->
<div>
    <section class="hero-service-wrap hero-section-wrap hero-overview-wrap hero-how-we-do-wrap">
        <div class="hero-section-content-wrap">
            <div class="custom-container">
                <div class="hero-section-content text-center">
                    <h1 class="section-title fade-in fnt-cl">Shopping Card</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- 3d sec -->
    <section class="how-it-works py-5 bg-light">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center text-lg-start">
            <h2 class="text-uppercase text-dark text-center">Shopping Card</h2>
            <div class="main">
                <div class="row mt-5">
                </div>
                @foreach ($cart as $index => $item)
                @if ($index % 3 === 0)
                    <div class="row mt-2">
                @endif
                {{-- <div class="row mt-2"> --}}
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
                        <div class="menu-content item-section">
                            {{-- <img src="assets/imgs/meet-ic.png"> --}}
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->name }}">

                            <div class="item-details">
                                <h3>Fresh Boneless Meat</h3>
                                <p>{{$item->variant->variant_name}}{{$item->variant->variant_value}} x <span class="price">{{$item->quantity}}</span></p>
                            </div>
                            <button class="close-btn">&times;</button>
                        </div>
                    </div>
                @if ($index % 3 === 2 || $item->last)
                    </div>
                @endif
                @endforeach
                <div class="row mt-4">
                    <div class="cart-header">
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6 col-xs-6">
                            <span>2 Product</span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6 col-xs-6" align="right">
                            <span>$26.00</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12">
                        <button class="checkout-btn">Checkout</button>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12">
                        <button class="go-to-cart-btn">Go To Cart</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>