<div class="w-3/4 mx-auto " style=" 
            /* border: .5px solid rgb(100, 100, 100);  */
            /* background-color: white;
            padding: 20px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            color: black;
            text-align: center;  */
            "
            >
    <h1 class="text-2xl font-bold">Manage Categories</h1>

    <div class="w-4/5 border-div" style="">
        <x-breadcrumb />
    </div>


    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class=" border-div">
        <h5 class="text-2xl font-bold">  {{ $categoryId ? 'Update Category' : 'Create Category' }}</h5>
        <form wire:submit.prevent="{{ $categoryId ? 'updateCategory' : 'createCategory' }}">
            {{-- <input type="text" wire:model="name" placeholder="Category Name" required> --}}
            <div class="col-span-2 md:col-span-1 grid grid-cols-2 gap-6 mb-6" >
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" wire:model="name" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('name') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="col-span-2 md:col-span-1 grid grid-cols-2 gap-6 mb-6" >
                <label for="name" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea wire:model="description" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Category Description"></textarea>
            </div>             --}}
            <button type="submit" class="custom-button">
                {{ $categoryId ? 'Update Category' : 'Create Category' }}
            </button>
        </form>    
    </div>
    <div class=" border-div">
    
        <div class=" border-div">
            <!-- Product List -->
             <table class="w-full border-collapse border border-gray-300 table-auto">
                 <thead>
                     <tr>
                         <th class="border border-gray-300">Name</th>
                         <th class="border border-gray-300">Description</th>
                         <th class="border border-gray-300">Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($categories as $category)
                        <tr>
                             <td class="border border-gray-300">{{ $category->name }}</td>
                             <td class="border border-gray-300">{{ $category->slug }}</td>
                             <td class="border border-gray-300">
                                 <button wire:click="editCategory({{ $category->id }})" class="bg-yellow-500 text-white p-1">Edit</button>
                                 <button wire:click="deleteCategory({{ $category->id }})" class="bg-red-500 text-white p-1">Delete</button>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
    </div>

</div>
