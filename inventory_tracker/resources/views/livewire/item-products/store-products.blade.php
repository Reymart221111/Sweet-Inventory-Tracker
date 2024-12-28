<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-show="openModal"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
    <!-- Increased max-width to make the modal wider -->
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4" x-show="openModal"
        @store-event.window="openModal = false" x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="scale-100 opacity-100"
        x-transition:leave-end="scale-95 opacity-0">

        <!-- Modal Header -->
        <div class="bg-sweetPink text-white p-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">Add New Product</h2>
                <button @click="openModal = false" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Form with Alpine.js Data -->
        <form wire:submit.prevent="storeProduct" class="p-6 space-y-4" x-data="{
                open: false,
                search: @entangle('search'),
                selectedCategory: @entangle('category'),
                categories: @js($availableCategories),
                image: null,
                imagePreview: null,
                handleImageUpload(event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        this.image = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        this.image = null;
                        this.imagePreview = null;
                    }
                }
            }">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Left Column -->
                <div class="space-y-3">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-1">Product Name</label>
                        <input type="text" name="name" id="name" wire:model.live="name" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-1">Price ($)</label>
                        <input type="number" step="0.01" name="price" id="price" wire:model.live="price" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-3">
                    <!-- Based Price -->
                    <div>
                        <label for="based_price" class="block text-gray-700 font-medium mb-1">Based Price ($)</label>
                        <input type="number" step="0.01" name="based_price" id="based_price"
                            wire:model.live="based_price" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('based_price') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('based_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stocks -->
                    <div>
                        <label for="stocks" class="block text-gray-700 font-medium mb-1">Stocks</label>
                        <input type="number" name="stocks" id="stocks" wire:model.live="stocks" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('stocks') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('stocks')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Image Upload with Client-Side Preview -->
            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-1">Product Image</label>
                <div class="flex items-center justify-center w-full">
                    <label
                        class="flex flex-col w-full h-40 border-4 border-dashed hover:bg-gray-100 hover:border-sweetPink group relative rounded-lg">
                        <!-- Image Preview -->
                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="Image Preview" class="w-full h-full object-cover rounded-lg">
                        </template>
                        <!-- Upload Prompt -->
                        <template x-if="!imagePreview">
                            <div class="flex flex-col items-center justify-center h-full">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-sweetPink" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-sweetPink">
                                    Select a photo
                                </p>
                            </div>
                        </template>
                        <!-- File Input: Accept only images -->
                        <input type="file" name="image" id="image" wire:model.live='image' accept="image/*" @change="handleImageUpload($event)"
                            class="opacity-0 absolute inset-0 cursor-pointer" />
                    </label>
                </div>

                @error('image')
                <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Select with Search -->
            <div class="relative mt-6">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <input type="text" id="category" x-model="search" @focus="open = true" @click.away="open = false"
                    wire:model.live="search"
                    class="w-full px-4 py-3 text-base text-gray-700 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sweetPink focus:border-sweetPink"
                    placeholder="Search categories..." required>

                @error('search')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @error('category_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div x-show="open" x-transition
                    class="absolute z-50 w-full mt-1 overflow-y-auto bg-white border border-gray-300 rounded-md shadow-lg max-h-60">
                    <ul class="divide-y divide-gray-200">
                        <!-- Limiting results to 3 items -->
                        <template
                            x-for="category in categories.filter(c => c.name.toLowerCase().includes(search.toLowerCase())).slice(0, 3)"
                            :key="category.id">
                            <li @click="selectedCategory = category.id; search = category.name; open = false; $wire.set('category_id', category.id); $wire.set('search', category.name)"
                                class="px-4 py-2 transition duration-200 cursor-pointer hover:bg-sweetYellowLight focus:bg-sweetYellow">
                                <div class="flex items-center">
                                    <span x-text="category.id + ' =>'" class="font-medium text-gray-900"></span>
                                    <span class="ml-2 text-gray-700" x-text="category.name"></span>
                                </div>
                            </li>
                        </template>
                        <li x-show="categories.filter(c => c.name.toLowerCase().includes(search.toLowerCase())).length === 0 && search"
                            class="px-4 py-2 text-gray-500">
                            No categories found.
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Modal Actions -->
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" @click="openModal = false"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg focus:outline-none transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-sweetPink hover:bg-sweetPinkDark text-white rounded-lg focus:outline-none transition-colors">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>