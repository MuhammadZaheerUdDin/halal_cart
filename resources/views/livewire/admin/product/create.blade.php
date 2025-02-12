<div class="w-3/4 mx-auto" >
    <h1 class="text-2xl font-bold">Manage Products (Update Product and Variants)</h1>

    <div class="w-4/5 border-div" style="">
        <x-breadcrumb />
    </div>

    <!-- Form -->
    <div class="border-div">
        <h5 class="text-2xl font-bold">  {{ $isEditing ? 'Update Product' : 'Create Product' }}</h1>
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 mb-4" style="border-radius:10px;">
                {{ session('message') }}
            </div>
        @endif
                
        <form wire:submit.prevent="{{ $isEditing ? 'updateProduct' : 'createProduct' }}" class="grid grid-cols-2 gap-6 mb-6  border-div border-div-inner">
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
                    <select wire:model="subcategory_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Sub-Category</option>
                        @foreach($subcategories as $sub)
                            @if($category_id==$sub->id)
                                <option value="{{ $sub->id }}" selected>{{ $sub->name }}</option>
                            @else
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                            @endif
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
            <!-- Image -->
            <div class="col-span-2 md:col-span-2">
                <label class="block">
                    <span class="text-sm text-slate-500">Choose Product Profile Image</span>
                    <div style="text-align:center">
                    <input type="file" id="" wire:model="image"  class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100
                    " />
                    </div>
                </label>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
               <!-- error('image') 
                    <span class="text-red-500 text-sm">{ { $message }}</span>
                enderror
                 -->
            </div>

                <!-- Description -->
            <div>
            <div class="col-span-2 md:col-span-1">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea id="description" wire:model="description" rows="5" 
                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                @error('description') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
                <!-- Ingredients -->
            <div class="col-span-2 md:col-span-1">
                <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients / Box Items:</label>
                <textarea id="ingredients" wire:model="ingredients" rows="5" placeholder="Enter ingredients, separated by commas"
                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                @error('ingredients') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            </div>
                <!-- Product Variants-->
            <div class=" md:col-span-1 border-div">
                <div class="col-span-2">
                    <h3 class="font-bold mb-2">Add Variants</h3>
                </div>
                <div class="col-span-2 md:col-span-1 p-1">
                    <input type="text" wire:model="variant_name" placeholder="Variant Name (e.g., lbs)" class="p-2 border rounded mb-2">
                </div>
                <div class="col-span-2 md:col-span-1 p-1">
                    <input type="text" wire:model="variant_value" placeholder="Variant Value (e.g., 1,2,3)" class="p-2 border rounded mb-2">
                </div>
                <div class="col-span-2 md:col-span-1 p-1">
                    <input type="number" wire:model="variant_price" placeholder="Price Adjustment (if not place '0')" class="p-2 border rounded mb-2">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <input type="number" wire:model="variant_stock" placeholder="Stock" class="p-2 border rounded mb-2">
                    <div class="p-2">
                        <button type="button" wire:click="addVariant" class="bg-blue-500 text-white px-4 py-2 rounded">Add Variant</button>
                    </div>
                </div>    
            </div>    
            <!-- Images -->
            <div class="col-span-2 md:col-span-2">
                <label class="block">
                    <span class="text-sm text-slate-500">Upload Product Image's (*)</span>
                    <input type="file" id="images" wire:model="images"  class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100
                    " multiple/>
                </label>
                @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
               <!-- error('image') 
                    <span class="text-red-500 text-sm">{ { $message }}</span>
                enderror
                 -->
            </div>
            <!-- Preview Section -->
            <div class="mt-4 grid grid-cols-3 gap-4">
                @if($previewImages)
                    @foreach($previewImages as $image)
                        <div class="relative border rounded p-2">
                            <img src="{{ $image }}" alt="Preview Image" class="w-full h-32 object-cover rounded">
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Submit Button -->
            <div class="col-span-2">
                <button type="submit" 
                        class="custom-button">
                    {{ $isEditing ? 'Update Product' : 'Add Product' }}
                </button>
            </div>                        
        </form>

        @if($isEditing && !empty($variants))
            <h5 class="text-2xl font-bold">  {{  'Update Variants' }}</h1>
                    {{-- <div class="grid grid-cols-2 gap-6 mb-6 border-2 p-1  rounded-lg" style="border-color:rgb(121, 116, 116)"> --}}
            @if (session()->has('variant_success_message'))
                <div class="bg-green-500 text-white mb-4"  style="border-radius:10px;">
                    <label>
                    {{ session('variant_success_message') }}
                    </label>
                </div>
            @endif
    
    
            <div class="grid grid-cols-2 gap-6 mb-6 border-separate border-opacity-10 border-div border-div-inner">
                @foreach($variants as $index => $variant)
                    <div class="col-span-2  md:col-span-1 border-r-2 border-dashed border-r-emerald-50  border-div ">
                        <h6 class="text-2xl font-bold">Variant {{ $index + 1 }}</h6>
    
                        <div class="col-span-2 md:col-span-1">
                            <label for="variant_name" class="block text-sm font-medium text-gray-700">Variant Name:</label>
                            <input type="text" wire:model="variants.{{ $index }}.variant_name" class="p-2 border rounded">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="variant_value" class="block text-sm font-medium text-gray-700">Variant Value:</label>
                            <input type="text" wire:model="variants.{{ $index }}.variant_value" class="p-2 border rounded">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="variant_price" class="block text-sm font-medium text-gray-700">Variant Price:</label>
                            <input type="text" wire:model="variants.{{ $index }}.price" class="p-2 border rounded">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="variant_stock" class="block text-sm font-medium text-gray-700">Variant Stock:</label>
                            <input type="number" wire:model="variants.{{ $index }}.stock" class="p-2 border rounded">
                        </div>
                        <div class="col-span-2 grid grid-cols-2 border-div">
                            <!-- Disable Variant Option -->
                            <label for="is_disabled" class="block text-sm font-medium text-gray-700">Disable Variant:</label>
                            <input type="checkbox" wire:model="variants.{{ $index }}.is_disabled" 
                                @if($variant['is_disabled']) checked @endif
                            class="p-2 border rounded">
                            {{-- @if($variantHasOrders)
                                <span class="text-sm text-red-500">This variant has been ordered and cannot be disabled.</span>
                            @endif --}}
                        </div>
                        <div class="col-span-2 md:col-span-1" @style('padding-top:8px')>
                            <button type="button" wire:click="updateVariant({{ $index }} )" class="bg-blue-500 text-white px-4 py-2 rounded">Update Variant</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>