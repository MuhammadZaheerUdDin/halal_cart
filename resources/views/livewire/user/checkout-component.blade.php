        <!-- 2nd sec -->
        <section class="contact-area">
            <div class="custom-container col-md-12">
                <div class="custom-row">
                    <div class="contact-form-wrap col-md-7">
                        <div class="contact-form-body">
                            <h4 class="section-title">{{ $title }}</h4>
                            {{-- {{ dd($address) }} --}}
                            @if (session()->has('message'))
                                <div class=" text-red p-2 mb-4" id="success-message" style="background-color:#41b941;border-radius: 1rem;" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class=" text-red p-2 mb-4"  id="error-message" style="background-color:red" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(!$show_address)
                                <div class="col-md-12" style="display: flex;">
                                    <span style="padding-right: 15px; display:flex;">
                                    {{ $first_name }} {{ $last_name }} 
                                    </span>
                                    <span style="padding-right: 5px;">
                                        {{ $phone_number }}
                                    </span>
                                </div>
                                <div class="col-md-12" style="display: flex;">
                                    <span style="padding-right: 15px; display:flex;">
                                        @if(!empty($address))
                                            {{ $address }}
                                        @endif
                                    </span>
                                </div>
                                <button class="btn over-layer" wire:click="editAddress" >{{ $button_label }}</button>                                
                            @endif
                            @if($show_address)
                            <div class="modal" style="display: flex;">
                                <div class="modal-content aut-scrol">
                                    <div class="modal-header header-bar" style="padding: 0px 10px 12px 12px !important;" style="">
                                        <span class="fnt-16">Update Address</span>
                                        <span class="close-button0" id="closeModal" wire:click="closeModal">&times;</span>
                                    </div>
                                    <div class="row ">
                                        <form id="checkout-form " action="" method="POST" class="contact-form">
                                            {{-- @if (session()->has('message'))
                                                <div class=" text-red p-2 mb-4 d-none" id="success-message" style="background-color:green" role="alert">
                                                    {{ session('message') }}
                                                </div>
                                            @endif --}}
                                            @if (session()->has('address_error'))
                                                <div class=" text-red p-2 mb-4 "  id="error-message" style="background-color:red" role="alert">
                                                    {{ session('address_error') }}
                                                </div>
                                            @endif
                                                        {{-- @csrf --}}
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" id="first_name" wire:model="first_name" placeholder="First Name" />
                                                    @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="input-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" id="last_name" wire:model="last_name" placeholder="Last Name" />
                                                    @error('last_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="text" id="phone_number" wire:model="phone_number" placeholder="phone number" />
                                                    @error('phone_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="input-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" id="email" wire:model="email" placeholder="Enter Email" />
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-row">
                                                    <div class="input-group">
                                                        <label for="street">Street Address</label>
                                                        <input type="text" id="street" wire:model="address1" placeholder="Address" />
                                                        @error('address1')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="input-row">
                                                    <div class="input-group">
                                                        <label for="address2">Address 2</label>
                                                        <input type="text" id="address2" wire:model="address2" placeholder="Address 2 (optional) " />
                                                        @error('address2')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label for="city">City</label>
                                                    <input type="text" id="city" wire:model="city" placeholder="Enter City" />
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="input-group">
                                                    <label for="state">States</label>
                                                    <select id="state" wire:model="state" data-style="form-select bg-transparent border-0" data-container="body" data-live-search="true" class="selectpicker form-control" required="" fdprocessedid="i7purip">
                                                        <option selected="">Select</option>
                                                        @foreach ($states as $key=>$state)
                                                            <option data-icon="me-1" value="{{ $key }}">{{ $state }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('state')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label for="postal_code">Postal/Zip Code</label>
                                                    <input type="text" id="postal_code" wire:model="postal_code" placeholder="Enter Post Code" />
                                                    @error('postal_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="input-group">
                                                    <label for="country">Country / Region</label>
                                                    <select id="select_bene" data-style="form-select bg-transparent border-0" wire:model="country" data-container="body" data-live-search="true" class="selectpicker form-control" required="" fdprocessedid="i7purip">
                                                        <option data-icon="me-1" value="US">Country</option>
                                                        <option data-icon="me-1" value="US">United States</option>
                                                    </select>
                                                    @error('country')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>                                            
                                            </div>
                                            <hr>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    {{-- <button id="submit" class="theme-btn">Pay Now</button> --}}
                                                    <button wire:click='addAddress'  id='pay-btn' type="button" class="theme-btn">Update Address</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <hr>
                            @if(!empty($address))                            
                                <form id="checkout-form" action="{{ route('checkout.payment') }}" method="POST" class="contact-form">
                                    @csrf
                                    <div class="bg-clr mb-2" style="background: #fff9e5;padding: 9px;border-radius: 4px;">
                                        <b class="f-2">Payment Method</b><br>
                                        <span>All transactions are secure and encrypted.</span>
                                        <div class="payment-method mb-2 mt-2">
                                            <label>
                                            <input type="radio" wire.model="payment" value="credit-card" checked>
                                            <span class="radio-label">
                                                Credit card
                                                <div class="card-icons" align="right">
                                                    <img src="{{ asset('assets/imgs/cards.png') }}" alt="Mastercard">
                                                </div>
                                            </span>
                                            </label>
                                        </div>
                                        <input type='hidden' name='stripe_token' id='stripe-token-id'>                                
                                        <div class="input-row">
                                            <div class="input-group">
                                                <div id="card-element" class="form-control" ></div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input type='hidden' name='stripeToken' id='stripe-token-id'>                               --}}
                                    <div class="input-row">
                                        <div class="input-group">
                                            {{-- <button id="submit" class="theme-btn">Pay Now</button> --}}
                                            <button onclick='createToken()'  id='pay-btn' type="button" class="theme-btn">Pay Now</button>
                                        </div>
                                    </div>
                                    <span>Your info will be saved to a Shop account. By continuing, you agree to Shop’s <a href="">Terms of Service</a> and acknowledge the <a href="">Privacy Policy</a>.</span>
                                    <!-- Alert Message -->
                                    <div class="input-row">
                                        <div class="input-group alert-notification">
                                            <div id="alert-message" class="alert-msg"></div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="contact-form-wrap col-md-5">
                        <div class="contact-form-body">
                            <h4 class="section-title">Order Summery</h4>
                            @if(!empty($cart) && !empty(Auth::user()))
                            @foreach ($cart as $cart_item)
                
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/'.$cart_item->product->image) }}"  class="checkout-img">
                                    </div>
                                    <div class="col-md-5">
                                        <span>{{ $cart_item->product->name }}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="first_name">x{{ $cart_item->quantity }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <b >${{ $cart_item->total }}</b>
                                    </div>
                                </div>
                            @endforeach            
                            @endempty
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Subtotal :</span>
                                </div>
                                <div class="col-md-6" align="right">
                                    <span>$ @if(empty($cart)){{ '0' }} @else{{ $cart->sum('total') }} @endif</span> 
                                </div>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Shipping :</span>
                                </div>
                                <div class="col-md-6" align="right">
                                    <span >Free</span>
                                </div>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-6" >
                                    <b>Total :</b>
                                </div>
                                <div class="col-md-6" align="right">
                                    <b>$
                                        @if(empty($cart))
                                            {{ '0' }}
                                        @else
                                            {{ $cart->sum('total') }}
                                         @endif
                                    </b> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style type="text/css">
                #card-element{
                    height: 50px;
                    padding-top: 16px;
                }
            </style>            
    {{-- @script      --}}
    <script type="text/javascript">
    //alert('zaheer');
    //alert(window.STRIPE_KEY);
            // if (typeof window.STRIPE_KEY !== 'undefined') {      
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');//Stripe(window.STRIPE_KEY);
            var elements = stripe.elements();
            // var cardElement = elements.create('card');
            var cardElement = elements.create('card', {
                style: {
                    base: {
                        // Customize styles here
                        base: {
                        color: '#32325d',
                        fontFamily: 'Arial, sans-serif',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4',
                        },
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a',
                        },                        
                    },
                },
                hidePostalCode: true, // Show the postal code field
            });
            cardElement.mount('#card-element');
            // }
            
            function createToken() {
                // alert('zsss');
                document.getElementById("pay-btn").disabled = true;
                stripe.createToken(cardElement).then(function(result) {
            
                    if(typeof result.error != 'undefined') {
                        document.getElementById("pay-btn").disabled = false;
                        alert(result.error.message);
                    }
            
                    /* creating token success */
                    if(typeof result.token != 'undefined') {
                        document.getElementById("stripe-token-id").value = result.token.id;
                        document.getElementById('checkout-form').submit();
                    }
                });
            }
  
    </script>
    {{-- @endscript --}}
</section>
