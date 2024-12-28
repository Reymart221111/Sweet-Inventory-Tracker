<div class="bg-white p-6 rounded-lg shadow-md" x-data="{ 
    openModal: false,
    openEditModal: false,
    closeModal() {
         this.openModal = false;
        } 
    }">
    <div class="flex items-center justify-between mb-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-semibold text-sweetPinkDark">Item Categories</h1>

        <!-- Add Category Button -->
        <button @click="openModal = true"
            class="inline-block px-4 py-2 bg-sweetPink hover:bg-sweetPinkDark text-white rounded shadow transition-colors">
            + Add Category
        </button>
    </div>

    <!-- Session Messages -->
    @include('includes.session-message')

    <!-- Search Form -->
    <form method="GET" class="mb-4" wire:submit.prevent>
        <div class="relative">
            <input type="text" name="search" placeholder="Search categories..." wire:model.live="search"
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

    <!-- Categories Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left bg-sweetPink text-white">
                    <th class="p-3 font-medium">Name</th>
                    <th class="p-3 font-medium">Description</th>
                    <th class="p-3 font-medium w-40">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($categories as $category)
                <tr class="bg-white hover:bg-sweetYellowLight">
                    <td class="p-3">
                        <span class="text-sweetPinkDark font-semibold">{{ $category->name }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $category->description }}</span>
                    </td>
                    <td class="p-3 flex space-x-2">
                        <!-- Edit Action -->
                        <button @click="openEditModal = true"
                            wire:click='$dispatch("updateCategory", { "recordId": {{$category->id}} })'
                            class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm transition-colors">
                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 17h2M12 2v2M4.22 4.22l1.42 1.42M16.64 16.64l1.42 1.42M2 12h2m16 0h2M7.757 7.757l10.486 10.486a1 1 0 01-1.414 1.414L6.343 9.171a1 1 0 011.414-1.414z" />
                            </svg>
                            Edit
                        </button>
                        @if (Auth::user()->role === 'admin')
                        <!-- Delete Action -->
                        <button wire:click='deleteCategory({{$category->id}})'
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
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        No categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Category Modal -->
    @livewire('item-categories.store-categories')

    <!-- Update Category Modal -->
    @livewire('item-categories.update-categories')

    <!-- Pagination (if applicable) -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>



</div>