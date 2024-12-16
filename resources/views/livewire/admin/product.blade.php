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

    <!-- body  -->
    <div class=" border-div">
        <button type="button" onclick="window.location.href='{{ route('admin.product.create') }}'"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Create Product</button>

        <input type="text" wire:model.live="search" placeholder="Search Products..." class="p-2 border rounded mb-4 w-full">

        <!-- Product List -->
        {{-- <table class="w-full border-collapse border border-gray-700 table table-auto  rounded-lg"> --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-950 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">    
                    {{-- <thead> --}}
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Stock</th>
                        <th scope="col" class="px-6 py-3">Variants</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($all_products as $product)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
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
                                <div class="col-span-2 md:col-span-1 flex space-x-2">
                                    <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" 
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Edit
                                    </a>
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center border border-gray-300 p-2">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $all_products->links() }} <!-- Tailwind pagination links -->
        </div>
    </div>
</div>
