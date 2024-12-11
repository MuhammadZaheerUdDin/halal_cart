<div class="w-3/4 mx-auto">
    <!-- Breadcrumb -->
    <nav class="relative xl:col-span-5" style="box-sizing:border-box;border:0 solid #e5e7eb ">
        {{-- class="relative xl:col-span-5" --}}
        <a href="/" class="hover:text-gray-800">Home</a>
        <span class="text-gray-400">/</span>
        <a href="#" class="hover:text-gray-800">Shop</a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-800 font-medium">Products</span>
    </nav>

    <!-- Products Table -->
    <h1 class="text-2xl font-bold mb-4">All Products</h1>
    <table class="table-auto w-full border-collapse border border-gray-200 bg-white" >
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Price</th>
                <th class="border border-gray-300 px-4 py-2">Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->price }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
