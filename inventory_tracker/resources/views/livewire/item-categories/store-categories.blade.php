<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-show="openModal"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4" x-show="openModal" @store-event.window="openModal = false"
        x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="scale-95"
        x-transition:enter-end="scale-100" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="scale-100" x-transition:leave-end="scale-95">

        <div class="flex items-center justify-between border-b border-gray-300 p-4">
            <h2 class="text-xl font-semibold text-sweetPinkDark">Add New Category</h2>
            <button @click="openModal = false" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <form wire:submit.prevent='storeCategory' class="p-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="name" wire:model.live='name' required
                    class="w-full p-3 rounded border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" wire:model.live='description' rows="3"
                    class="w-full p-3 rounded border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight"></textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" @click="openModal = false"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-sweetPink hover:bg-sweetPinkDark text-white rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>