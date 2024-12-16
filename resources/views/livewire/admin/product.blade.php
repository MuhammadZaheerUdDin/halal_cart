<div class="w-3/4 mx-auto" >
    <h1 class="text-2xl font-bold">Manage Products</h1>

    <div class="w-4/5 border-div" style="">
        <x-breadcrumb />
    </div>


    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form -->
    {{-- <div class="border-div"> --}}
        {{-- <h5 class="text-2xl font-bold">  {{ $isEditing ? 'Update Product' : 'Create Product' }}</h1> --}}
            
        {{-- <form wire:submit.prevent="{{ $isEditing ? 'updateProduct' : 'createProduct' }}" class="grid grid-cols-2 gap-6 mb-6">
            <!-- Product Info-->
            <!-- <div class="col-span-2">
                <div class="col-span-4 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Category:</label>
                    <select wire:model="category_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @ foreach($categories as $category)
                            <option value="{ { $categories->id }}">{ { $categories->name }}</option>
                        @ endforeach
                    </select>
                </div>        
            </div> -->
            <div class="col-span-2">
                <div class="col-span-4 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Halal Categories:</label>
                    <select wire:model="category_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Sub-Category</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>        
            </div>
                <!-- Name -->   
            <div class="col-span-2 md:col-span-1">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" wire:model="name" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('name') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
                <!-- Price -->
            <div class="col-span-2 md:col-span-1">
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="text" id="price" wire:model="price" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 font-semibold text-xl text-gray-800 leading-tight">
                @error('price') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
                <!-- Stock -->
            <div class="col-span-2 md:col-span-1">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
                <input type="number" id="stock" wire:model="stock" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('stock') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
                <!-- SKU -->
            <div class="col-span-2 md:col-span-1">
                <label for="sku" class="block text-sm font-medium text-gray-700">SKU:</label>
                <input type="text" id="sku" wire:model="sku" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('sku') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>        
                <!-- Description -->
            <div class="col-span-2 md:col-span-1">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea id="description" wire:model="description" 
                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                @error('description') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Product Variants-->
            <div class="col-span-2">
                <h3 class="font-bold mb-2">Add Variants</h3>
            </div>
            <div class="col-span-2 md:col-span-1">
                <input type="text" wire:model="variant_name" placeholder="Variant Name (e.g., Size)" class="p-2 border rounded mb-2">
            </div>
            <div class="col-span-2 md:col-span-1">
                <input type="text" wire:model="variant_value" placeholder="Variant Value (e.g., Large)" class="p-2 border rounded mb-2">
            </div>
            <div class="col-span-2 md:col-span-1">
                <input type="number" wire:model="variant_price" placeholder="Price Adjustment" class="p-2 border rounded mb-2">
            </div>
            <div class="col-span-2 md:col-span-1">
                <input type="number" wire:model="variant_stock" placeholder="Stock" class="p-2 border rounded mb-2">
                <button type="button" wire:click="addVariant" class="bg-blue-500 text-white px-4 py-2 rounded">Add Variant</button>
            </div>
            <!-- Image -->
            <div class="col-span-2 md:col-span-1">
                <label class="block">
                    <span class="sr-only">Choose Product Image</span>
                    <input type="file" id="images" wire:model="images"  class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100
                    "/>
                </label>
                @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
               <!-- error('image') 
                    <span class="text-red-500 text-sm">{ { $message }}</span>
                enderror
                 -->
            </div>
            <!-- Submit Button -->
            <div class="col-span-2">
                <button type="submit" 
                        class="custom-button">
                    {{ $isEditing ? 'Update Product' : 'Add Product' }}
                </button>
            </div>
                        
        </form> --}}
        
    {{-- </div> --}}

    <!-- body  -->
    <div class=" border-div">
    <input type="text" wire:model.live="search" placeholder="Search Products..." class="p-2 border rounded mb-4 w-full">

        <!-- Product List -->
        <table class="w-full border-collapse border border-gray-700 table table-auto  rounded-lg">
            <thead>
                <tr>
                    <th class="border border-gray-300">Name</th>
                    <th class="border border-gray-300">Price</th>
                    <th class="border border-gray-300">Stock</th>
                    <th class="border border-gray-300">Variants</th>
                    <th class="border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($all_products as $product)
                    <tr>
                        <td class="border border-gray-300">{{ $product->name }}</td>
                        <td class="border border-gray-300">${{ $product->price }}</td>
                        <td class="border border-gray-300">{{ $product->stock }}</td>
                        <td class="border border-gray-300 p-2">
                            @if(!empty($product->variants))
                                <table class="w-full border-collapse ">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-300 p-1">Name</th>
                                            <th class="border border-gray-300 p-1">Value</th>
                                            <th class="border border-gray-300 p-1">Price</th>
                                            <th class="border border-gray-300 p-1">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->variants as $variant)
                                            <tr>
                                                <td class="border border-gray-300 p-1">{{ $variant->variant_name }}</td>
                                                <td class="border border-gray-300 p-1">{{ $variant->variant_value }}</td>
                                                <td class="border border-gray-300 p-1">{{ $variant->price }}</td>
                                                <td class="border border-gray-300 p-1">{{ $variant->stock }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </td>
                        <td class="border border-gray-300">
                            {{-- <button wire:click="editProduct({{ $product->id }})" class="bg-yellow-500 text-white p-1">Edit</button> --}}
                            <a href="{{ route('admin.product.create', ['id' => $product->id]) }}" 
                                class="bg-yellow-500 text-white p-1">
                                Edit
                             </a>
                             <br>
                            <button wire:click="deleteProduct({{ $product->id }})" class="bg-red-500 text-white p-1">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center border border-gray-300 p-2">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $all_products->links() }} <!-- Tailwind pagination links -->
        </div>
    </div>
</div>
