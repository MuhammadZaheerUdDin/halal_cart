<div class="container mx-auto p-4">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class="product-details bg-white shadow rounded-lg p-6">
        <!-- Product Details -->
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
        <p class="text-xl font-semibold text-blue-500 mt-4">Price: ${{ $product->price }}</p>
        
        <hr class="my-4">
        
        <!-- Quantity Input -->
 
        <!-- Quantity Increment/Decrement -->
        <div class="quantity-input mb-4 flex items-center">
            <button wire:click="decrementQuantity" 
                    class="bg-gray-300 text-gray-700 px-3 py-2 rounded-l focus:outline-none hover:bg-gray-400">
                -
            </button>
            <input type="number" wire:model="quantity" 
                   class="w-16 text-center border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                   readonly>
            <button wire:click="incrementQuantity" 
                    class="bg-gray-300 text-gray-700 px-3 py-2 rounded-r focus:outline-none hover:bg-gray-400">
                +
            </button>
        </div>
        
        <!-- Variant Selection -->
        <h2 class="text-lg font-semibold">Select a Variant:</h2>
        @if($product->variants->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                @foreach($product->variants as $variant)
                    <div 
                        class="variant cursor-pointer bg-gray-100 p-4 rounded-lg shadow border-2 transition-all 
                        @if($selectedVariant == $variant->id) border-blue-500 @else border-gray-100 @endif"
                        wire:click="selectVariant({{ $variant->id }})"
                    >
                        <h3 class="font-bold text-gray-800">{{ $variant->variant_name }}</h3>
                        <p class="text-gray-600">Value: {{ $variant->variant_value }}</p>
                        <p class="text-blue-500 font-semibold">Price: ${{ $variant->price }}</p>
                        <p class="text-green-500">Stock: {{ $variant->stock }}</p>
                        @if($variant->is_disabled)
                            <p class="text-red-500 font-semibold">This variant is disabled</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mt-4">No variants available for this product.</p>
        @endif

        <!-- Add to Cart Button -->
        <button 
            class="mt-6 bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300" 
            wire:click="addToCart">
            Add to Cart
        </button>
    </div>
</div>
