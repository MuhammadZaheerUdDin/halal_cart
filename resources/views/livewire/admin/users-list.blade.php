<div class="w-3/4 mx-auto" >
    <h1 class="text-2xl font-bold">Manage Products</h1>

    <div class="w-4/5 border-div" style="">
        <x-breadcrumb />
    </div>
    <h1>Users List</h1>
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class=" border-div">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

            {{-- <table class="min-w-full bg-white"> --}}
                <thead class="text-xs text-gray-950 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">    
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                            <td class="border border-gray-300 py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="border border-gray-300 py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="border border-gray-300 py-2 px-4 border-b">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>