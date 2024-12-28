<div class="container mx-auto p-8">
    <h1 class="text-4xl font-bold mb-10 text-center text-gradient bg-clip-text text-transparent bg-sweetPink">
        Point of Sale (POS) System
    </h1>

    <div class="flex flex-col md:flex-row gap-6">
        <!-- Product Listing Section -->
        <div class="w-full md:w-2/3">
            <div class="flex mb-6">
                <!-- Search Input -->
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search products..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetPink">
                <!-- Category Filter -->
                <select wire:model.live="filterCategory"
                    class="ml-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetPink">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div
                    class="border border-gray-200 bg-pink-200 p-6 rounded-xl hover:shadow-xl transition-shadow duration-300">
                    <!-- Product Image -->
                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover rounded-lg mb-4">

                    <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>

                    <p class="text-gray-600 mb-4">
                        Price: <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
                    </p>

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">Stock: {{ $product->stocks }}</span>
                    </div>

                    <!-- Quantity Selector and Add to Cart Button -->
                    <div class="flex items-center gap-4">
                        <!-- Updated wire:model binding with defer and step -->
                        <input type="number" wire:model.live="quantities.{{ $product->id }}" min="1"
                            max="{{ $product->stocks }}" step="1"
                            class="w-16 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetPink" />

                        @if($product->stocks == 0)
                        <button disabled
                            class="bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg shadow-md w-full cursor-not-allowed">
                            Out of Stock
                        </button>
                        @else
                        <button wire:click="addToCart({{ $product->id }})"
                            class="bg-sweetPink hover:bg-pink-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 w-full"
                            {{ ($quantities[$product->id] ?? 1) > $product->stocks ? 'disabled' : '' }}
                            >
                            Add to Cart
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Cart Summary Section -->
        @livewire('transaction.cart-summary')

    </div>
</div>