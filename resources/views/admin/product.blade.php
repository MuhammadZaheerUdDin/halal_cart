<div>
    <h1 class="text-2xl font-bold">Manage Products</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form -->
    <form wire:submit.prevent="{{ $isEditing ? 'updateProduct' : 'createProduct' }}" class="mb-6">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" wire:model="name" class="w-full">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" wire:model="description" class="w-full"></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" wire:model="price" class="w-full">
            @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" wire:model="stock" class="w-full">
            @error('stock') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="sku">SKU:</label>
            <input type="text" id="sku" wire:model="sku" class="w-full">
            @error('sku') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" wire:model="image" class="w-full">
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 mt-4">
            {{ $isEditing ? 'Update Product' : 'Add Product' }}
        </button>
    </form>

    <!-- Product List -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300">Name</th>
                <th class="border border-gray-300">Price</th>
                <th class="border border-gray-300">Stock</th>
                <th class="border border-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="border border-gray-300">{{ $product->name }}</td>
                    <td class="border border-gray-300">${{ $product->price }}</td>
                    <td class="border border-gray-300">{{ $product->stock }}</td>
                    <td class="border border-gray-300">
                        <button wire:click="editProduct({{ $product->id }})" class="bg-yellow-500 text-white p-1">Edit</button>
                        <button wire:click="deleteProduct({{ $product->id }})" class="bg-red-500 text-white p-1">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
