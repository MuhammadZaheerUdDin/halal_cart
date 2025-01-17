<div class="container mx-auto px-4 py-6">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach($products as $product)
            <!-- Product Card -->
            <div class="border border-gray-200 rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <img src="{{ 'storage/'.$product['image'] }}" alt="{{ $product['name'] }}" 
                     class="w-full h-32 object-cover rounded-md mb-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $product['name'] }}</h3>
                <p class="text-sm text-gray-600">{{ $product['description'] }}</p>
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-lg font-bold text-blue-500">${{ $product['price'] }}</span>

                    <button  wire:click="addToCart({{ $product->id }})" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
