<div class="w-3/4 mx-auto" >
    {{-- <button wire:click="getToken" class="bg-blue-500 text-white px-4 py-2 rounded">
        Order getToken
    </button>
    <a href="javascript:void(0);" class=" inline-block p-4 rounded-t-lg  "
     wire:click="getToken" aria-current="&quot;page&quot;">
        Paid
    </a> --}}
    <h1 class="text-2xl font-bold">Manage Products</h1>

    <div class="w-4/5 border-div" style="">
        <x-breadcrumb />
    </div>


    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- body -->
    <div class=" border-div">
        <button type="button" onclick="window.location.href='{{ route('admin.product.create') }}'"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
            Create Product
        </button>

        <!-- Product List -->
        {{-- <table class="w-full border-collapse border border-gray-700 table table-auto  rounded-lg"> --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


            <ul style="padding-bottom: 5px;" class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="me-2">
                    <a href="javascript:void(0);" {{ $status == 'all' ? 'aria-current="page"' : '' }} class=" inline-block p-4 rounded-t-lg {{ $status == 'all' ? ' dark:bg-gray-800 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 active' }}"  wire:click="showTab('all')">ALL</a>
                </li>
                <li class="me-2">
                    <a href="javascript:void(0);" {{ $status == 'paid' ? 'aria-current="page"' : '' }} class=" inline-block p-4 rounded-t-lg {{ $status == 'paid' ? ' dark:bg-gray-800 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 active' }}"  wire:click="showTab('paid')">Paid</a>
                </li>
                <li class="me-2">
                    <a href="javascript:void(0);" {{ $status == 'processing' ? 'aria-current="page"' : '' }} class=" inline-block p-4 rounded-t-lg {{ $status == 'processing' ? ' dark:bg-gray-800 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 active' }}"  wire:click="showTab('processing')">Processing</a>
                </li>
                <li class="me-2">
                    <a href="javascript:void(0);" {{ $status == 'paid' ? 'aria-current="page"' : '' }} class=" inline-block p-4 rounded-t-lg {{ $status == 'shipped' ? ' dark:bg-gray-800 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 active' }}"  wire:click="showTab('shipped')">Shipped</a>
                </li>
                <li class="me-2">
                    <a href="javascript:void(0);" {{ $status == 'paid' ? 'aria-current="page"' : '' }} class=" inline-block p-4 rounded-t-lg {{ $status == 'completed' ? ' dark:bg-gray-800 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 active' }}"  wire:click="showTab('completed')">Completed</a>
                </li>
                <li>
                    <a href="javascript:void(0);" {{ $status == 'paid' ? 'aria-current="page"' : '' }} class=" inline-block p-4 rounded-t-lg {{ $status == 'cancelled' ? ' dark:bg-gray-800 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 active' }}"  wire:click="showTab('cancelled')">Cancelled</a>
                </li>
            </ul>
            <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-950 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">    
                    {{-- <thead> --}}
                    <tr>
                        <th scope="col" class="px-6 py-3">Order #</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Quantity</th>
                        <th scope="col" class="px-6 py-3">Variants</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_orders as $product_order)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="text-center border border-gray-300">{{ $product_order->order_number }}</td>
                            <td class="border border-gray-300">{{ $product_order->created_at->format('d-m-Y h:i A') }}</td>
                            <td class="text-center border border-gray-300">${{ $product_order->total }}</td>
                            <td class="text-center border border-gray-300">{{ $product_order->orderProducts->sum('quantity') }}</td>
                            <td class="text-center border border-gray-300 p-2">
                                <table class="w-full border-collapse ">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-300 p-1">Name</th>
                                            <th class="border border-gray-300 p-1">Variant Type</th>
                                            <th class="border border-gray-300 p-1">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_order->orderProducts as $order_item)
                                            <tr>
                                                @if(!empty($order_item->product) && !empty($order_item->variant))
                                                    <td class="border border-gray-300 p-1">{{ $order_item->product->name }}</td>
                                                    <td class="border border-gray-300 p-1">{{ $order_item->variant->variant_name }} {{ $order_item->variant->variant_value }}</td>
                                                    <td class="border border-gray-300 p-1">{{ $order_item->quantity }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center ">
                                <div class="">
                                    @if($product_order->next_status)
                                        <span style="display: flow;"><b>Update Status</b></span>
                                        <button 
                                        onclick="showConfirmation('updateStatus', {{ $product_order->id }}, '{{ ucfirst($product_order->next_status) }}')"
                                        {{-- wire:click="updateStatus({{ $product_order->id }})" --}}
                                            class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            {{ ucfirst($product_order->next_status) }}
                                        </button>
                                    @elseif($product_order->status === 'cancelled')
                                        <span style="color:red">Cancelled</span>
                                    @else
                                        <span style="color:green">Completed</span>
                                    @endif
                                    @if(in_array($product_order->status, \App\Models\Order::$cancelableStatuses))
                                        <button
                                        {{-- onclick="showConfirmation('markFailedDelivery', {{ $product_order->id }}, 'Mark as Failed Delivery')"  --}}
                                        {{-- wire:click="cancelOrder({{ $product_order->id }})" --}}
                                        onclick="showConfirmation('cancelOrder', {{ $product_order->id }}, '{{ ucfirst('Cancel. <br>Order #'.$product_order->order_number.' of User <b>'.$product_order->user->name. '</b> $'.$product_order->total .' would be refunded <br>') }}')"
                                            class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            Cancel Order
                                        </button>
                                    @endif                                    
                                </div>
                            </td>
                        </tr>

                        {{-- @empty
                            <tr>
                                <td colspan="5" class="text-center border border-gray-300 p-2">No products found.</td>
                            </tr> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $product_orders->links() }} <!-- Tailwind pagination links -->
        </div>
    </div>
    <script>
        function showConfirmation(action, productId, message) {
            Swal.fire({
                title: 'Are you sure?',
                // text: `You are about to ${message}. This action cannot be undone.`,
                html: `
            <p>You are about to ${message}. This action cannot be undone.</p>
            <label>
                <input type="checkbox" id="confirmCheckbox"> I understand and agree
            </label>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel',
                didOpen: () => {
                    const confirmButton = Swal.getConfirmButton();
                    const checkbox = document.getElementById('confirmCheckbox');

                    confirmButton.disabled = true; // Initially disable confirm button

                    checkbox.addEventListener('change', () => {
                        confirmButton.disabled = !checkbox.checked; // Enable only when checked
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    try {
                    Livewire.dispatch(action, { product_id: productId });
                    if(action === 'cancelOrder'){
                        message = 'Order Cancel and Payment Refund'
                    }
                    Swal.fire(
                        'Success!',
                        `The action "${message}" has been performed.`,
                        'success'
                    );
                    } catch (e) {
                        console.log(e);
                    }
                }
            });
        }
    </script>
</div>
