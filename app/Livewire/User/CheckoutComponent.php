<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\ShippingAddress;
use App\Repositories\AddressRepository;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Stripe;
use Stripe\Charge;
// use App\Enums\CountryEnum;

class CheckoutComponent extends Component
{
    protected $cartRepository;
    protected $productRepository;
    protected $addressRepository;
    protected $orderRepository;

    public $first_name, $last_name, $email, $phone_number , $city , $state , $country , $postal_code, $address1 , $address2;
    public $title, $address, $show_address=false,$button_label;

    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
        $this->productRepository = app(ProductRepository::class);
        $this->addressRepository = app(AddressRepository::class);
        $this->orderRepository = app(OrderRepository::class);
    }

    public function mount() {
        $this->title="Shipping & Billing";
        if(!empty(Auth::user())){
            $address = $this->addressRepository->findById(Auth::user()->id);
            if(!empty($address)){
                $this->first_name = $address->first_name ?? null;
                $this->last_name = $address->last_name ?? null;
                $this->email = $address->email ?? null;
                $this->phone_number = $address->phone_number ?? null;
                $this->address1 = $address->address1 ?? null;
                $this->address2 = $address->address2 ?? null;
                $this->city = $address->city ?? null;
                $this->state = $address->state ?? null;
                $this->postal_code = $address->postal_code ?? null;
                $this->country = $address->country ?? null;   

                $this->address = $address->address1.($address->address2 ? ', ' . $address->address2 : '').','.
                $address->city.','.$address->state.','.$address->postal_code.','.
                $address->country;
                // dd($this->address);
            }
        }
        $this->button_label = empty($this->address) ? 'Add Shipping Address' : 'Edit';
    }

    public function render()
    {
        // $this->address = $this->addressRepository->findById(22);
        if(!empty(Auth::user())){
            // $cart = $this->cartRepository->getOrCreateCart($this->product->id);
            $cart = $this->cartRepository->getcartItems();//$cart->items()->with('itemable')->get() : [];
        }else{
            $cart=null;
        }
        $states = $usStates = [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ];
        
        return view('livewire.user.checkout-component',compact('cart','states'))->layout('layouts.app');
    }

    public function editAddress(){
        $this->show_address=true;
    }
 
    public function addAddress(){
        $validatedData = $this->validate([
            // 'user_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            // 'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:2',
        ]);
        $data = [
            'user_id'=>Auth::user()->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'phone_number'=>$this->phone_number,
            'address1'=>$this->address1,
            'address2'=>$this->address2,
            'city'=>$this->city,
            'state'=>$this->state,
            'postal_code'=>$this->postal_code,
            'country'=>$this->country
        ];
        $address = $this->addressRepository->create($data);
        if(!empty($address)){
            $this->show_address=false;
            session()->flash('message', 'Address updated successfully.');
            // $this->dispatch('successMessage');
        }else{
            session()->flash('address_error', 'Something went wrong ,Please fill all fields.');
        }
    }

    public function checkout(Request $request)//: RedirectResponse
    {
        DB::beginTransaction();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try{
            $cartItems = $this->cartRepository->getcartItems();
            $t_price = 0;
            $order_item = [];
            foreach($cartItems as $cart){
                $order_item[] = [ 'order_id' => 0, // Placeholder, will be updated after order creation
                'product_id' => $cart->itemable_id,
                'quantity' => $cart->quantity,
                'price' => $cart->variant->price
                ];
                $quantity = $cart->quantity;
                $price = $cart->variant->price;
                $product_total_price = (float)$price*(int)$quantity;
                $t_price +=$product_total_price;
            }
            $charge = Stripe\Charge::create ([
                "amount" => $t_price*100 ,
                "currency" => "usd",
                "source" => $request->stripe_token,
                "description" => "Test payment from itsolutionstuff.com." 

                ,"name" => $request->first_name
                ,"email" => $request->email
                ,"phone_number" => $request->phone_number
                ,"street" => $request->street
                ,"state" => $request->state
                ,"postal_code" => $request->postal_code
            ]);
            if ($charge->status === 'succeeded') {
                $address = $this->addressRepository->findById(Auth::user()->id);
                $order_array = [
                    'user_id'=>Auth::user()->id
                    ,'total'=>$t_price
                    ,'first_name'=> $address->first_name ?? null
                    ,'last_name'=> $address->last_name ?? null
                    ,'email'=> $address->email ?? null
                    ,'phone_number'=> $address->phone_number ?? null
                    ,'address1'=> $address->address1 ?? null
                    ,'address2'=>$address->address2 ?? null
                    ,'city'=> $address->city ?? null
                    ,'state'=>$address->state ?? null
                    ,'postal_code'=>$address->postal_code ?? null
                    ,'country'=>$address->country ?? null
                    ,'status'=>'paid' 
                    ,'is_paid'=>1
                ];
                $order = $this->orderRepository->create($order_array);
                if($order){
                    foreach ($order_item as &$item) {
                        $item['order_id'] = $order->id;
                    }
                    $this->orderRepository->addItems($order_item);
                }
                $cart = $this->cartRepository->getOrCreateCart(Auth::user()->id);
                $this->cartRepository->clearCart($cart);
    
                DB::commit();
                return redirect()->to('success')->with(['success'=>'Payment did not complete successfully.']);
                // session()->flash('message', 'Product added to cart successfully.');
            } else {
                DB::rollBack();
                session()->flash('error', 'Payment failed.');
                return redirect()->back()->with(['error'=>'Payment failure.']);
            }
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error', 'Payment failed.');
            return redirect()->back()->with(['error'=>'Payment failure.']);
        }
    }

}
