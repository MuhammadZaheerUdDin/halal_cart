<div class="w-3/4 mx-auto " style=" 
            /* border: .5px solid rgb(100, 100, 100);  */
            /* background-color: white;
            padding: 20px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            color: black;
            text-align: center;  */
            "
            >
    {{-- <h1 class="text-2xl font-bold">Manage Categories</h1> --}}
    <h2 class="text-2xl font-bold mb-4">Manage Subcategories</h2>

    <div class="w-4/5 border-div" style="">
        <x-breadcrumb />
    </div>


    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class=" border-div">
        <h5 class="text-2xl font-bold">  {{ $isEditing ? 'Update Category' : 'Create SubCategory' }}</h5>
        <form wire:submit.prevent="{{ $isEditing ? 'updateSubcategory' : 'createSubcategory' }}"  class="grid grid-cols-2 gap-6 mb-6">
            {{-- <input type="text" wire:model="name" placeholder="Category Name" required> --}}
            <div class="col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Category:</label>
                <select id="category_id" wire:model="category_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                    @error('name') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" wire:model="name" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('name') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-2 md:col-span-1">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                {{-- <input type="text" id="description" wire:model="description" 
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"> --}}
                    <textarea id="description" wire:model="description" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                    @error('description') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="col-span-2 md:col-span-1 grid grid-cols-2 gap-6 mb-6" >
                <label for="name" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea wire:model="description" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Category Description"></textarea>
            </div>             --}}
            <div class="col-span-2">
                <button type="submit" class="custom-button">
                    {{ $isEditing ? 'Update Category' : 'Create Category' }}
                </button>
            </div>
        </form>
    </div>
    <div class=" border-div">
    
        <div class=" border-div">
            <!-- Product List -->
             <table class="w-full border-collapse border border-gray-300 table-auto">
                 <thead>
                     <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300">Name</th>
                         <th class="border border-gray-300">Category</th>
                         <th class="border border-gray-300">Desciption</th>
                         <th class="border border-gray-300">Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($subcategories as $subcategory)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->index + 1 }}</td>
                             <td class="border border-gray-300">{{ $subcategory->name }}</td>
                             <td class="border border-gray-300">{{ $subcategory->category->name }}</td>
                             <td class="border border-gray-300">{{ $subcategory->description }}</td>
                             <td class="border border-gray-300">
                                 <button wire:click="editSubcategory({{ $subcategory->id }})" class="bg-yellow-500 text-white p-1">Edit</button>
                                 <button wire:click="deleteSubcategory({{ $subcategory->id }})" class="bg-red-500 text-white p-1">Delete</button>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
    </div>

</div>
