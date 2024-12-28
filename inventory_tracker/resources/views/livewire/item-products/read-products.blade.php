<div class="bg-white p-6 rounded-lg shadow-md" x-data="{ 
    openModal: false,
    openEditModal: false,
     closeModal() {
         this.openModal = false;
        } 
    }">
    <div class="flex items-center justify-between mb-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-semibold text-sweetPinkDark">Item Products</h1>

        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
        <!-- Add Category Button -->
        <button @click="openModal = true"
            class="inline-block px-4 py-2 bg-sweetPink hover:bg-sweetPinkDark text-white rounded shadow transition-colors">
            + Add Items
        </button>
        @endif
    </div>

    <!-- Session Messages -->
    @include('includes.session-message')

    <!-- Filter Section -->
    <div class="mb-4 flex space-x-4">
        <!-- Search Form -->
        <form class="flex-1">
            <div class="relative">
                <input type="text" name="search" placeholder="Search products..." wire:model.live="search"
                    class="w-full p-3 pl-10 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                <span class="absolute left-3 top-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M13 7a6 6 0 11-2.367-4.733l3.464 3.464A2 2 0 0013 7zM2 13a6 6 0 118 5.291V17a2 2 0 00-4 0v1.291A5.98 5.98 0 012 13z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
        </form>

        <!-- Category Filter -->
        <div class="flex-1">
            <select wire:model.live="selectedCategory"
                class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left bg-sweetPink text-white">
                    <th class="p-3 font-medium">#</th>
                    <th class="p-3 font-medium">Name</th>
                    <th class="p-3 font-medium">Image</th>
                    <th class="p-3 font-medium">Price</th>
                    <th class="p-3 font-medium">Based Price</th>
                    <th class="p-3 font-medium">Category</th>
                    <th class="p-3 font-medium">Stocks</th>
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                    <th class="p-3 font-medium w-40">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($products as $product)
                <tr class="bg-white hover:bg-sweetYellowLight">
                    <td class="p-3">
                        <span class="text-gray-700">#{{$product->id}}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-sweetPinkDark font-semibold">{{$product->name}}</span>
                    </td>
                    <td class="p-3">
                        <div class="w-20 h-20 overflow-hidden rounded-md">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('storage/uploads/no-photo/no-photo.png') }}"
                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">${{ number_format($product->price, 2) }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">${{ number_format($product->based_price, 2) }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $product->category->name ?? 'No Category' }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $product->stocks }}</span>
                    </td>
                    <td class="p-3 flex space-x-2 mt-6">

                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                        <!-- Edit Action -->
                        <button @click="openEditModal = true"
                            wire:click='$dispatch("updateProduct", { "recordId": {{$product->id}} })'
                            class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm transition-colors">
                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 17h2M12 2v2M4.22 4.22l1.42 1.42M16.64 16.64l1.42 1.42M2 12h2m16 0h2M7.757 7.757l10.486 10.486a1 1 0 01-1.414 1.414L6.343 9.171a1 1 0 011.414-1.414z" />
                            </svg>
                            Edit
                        </button>
                        @endif

                        @if (Auth::user()->role === 'admin')
                        <!-- Delete Action -->
                        <button wire:click="deleteProduct({{$product->id}})"
                            wire:confirm='Are you sure to delete this record?'
                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm transition-colors">
                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Delete
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="bg-white">
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                    <td colspan="8" class="p-4 text-center text-gray-500">No products found.</td>
                    @elseif(Auth::user()->role === 'employee')
                    <td colspan="7" class="p-4 text-center text-gray-500">No products found.</td>
                    @endif
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
    <!-- Add Category Modal -->
    @livewire('item-products.store-products')

    <!-- Update Category Modal -->
    @livewire('item-products.update-products')
    @endif

    <!-- Pagination (if applicable) -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>