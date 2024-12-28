<div class="w-full md:w-1/3 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Cart Summary</h2>

    @include('includes.session-message')

    <div id="cart" class="space-y-4 mb-6">
        @forelse($cartItems as $item)
        <div class="cart-item flex justify-between items-center p-4 bg-gray-50 rounded-lg shadow-lg">
            <div class="flex items-center">
                <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}"
                    class="w-16 h-16 object-cover rounded-lg mr-4">
                <div>
                    <p class="font-medium text-gray-800">{{ $item['name'] }}</p>
                    <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                </div>
            </div>
            <div>
                <p class="font-medium text-gray-800">${{ number_format($item['subtotal'], 2) }}</p>
                <button wire:click="removeFromCart({{ $item['product_id'] }})"
                    class="text-red-500 ml-4 hover:text-red-700">Remove</button>
            </div>
        </div>
        @empty
        <p class="text-gray-700">Your cart is empty.</p>
        @endforelse
    </div>

    <div id="totalAmount" class="text-right text-2xl font-semibold text-gray-800 mt-4">
        Total: ${{ number_format($totalAmount, 2) }}
    </div>
    
    <div class="border-t pt-6">
        <h3 class="text-xl font-medium mb-4 text-gray-800">Customer Details</h3>
        <form wire:submit.prevent="submitOrder" class="space-y-6">
            <div>
                <label for="customerName" class="block text-gray-700 font-medium mb-2">Name</label>
                <input 
                    type="text" 
                    wire:model.live="customerName" 
                    id="customerName" 
                    placeholder="Enter customer name"
                    class="w-full px-4 py-2 border {{ $errors->has('customerName') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetPink"
                >
                @error('customerName')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div>
                <label for="customerContact" class="block text-gray-700 font-medium mb-2">Contact</label>
                <input 
                    type="text" 
                    wire:model.live="customerContact" 
                    id="customerContact" 
                    placeholder="Enter contact number"
                    class="w-full px-4 py-2 border {{ $errors->has('customerContact') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetPink"
                >
                @error('customerContact')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div>
                @if (count($cartItems) == 0)
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-colors duration-300 opacity-50 cursor-not-allowed"
                        disabled>
                        No Product Added To Cart
                    </button>
                @else
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-colors duration-300"
                        {{ count($cartItems) == 0 ? 'disabled' : '' }}>
                        Submit Order
                    </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    @if($showConfirmationModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Confirm Order</h3>

            <div class="space-y-4 max-h-60 overflow-y-auto">
                @forelse($cartItems as $item)
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">${{ number_format($item['subtotal'], 2) }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-700">Your cart is empty.</p>
                @endforelse
            </div>

            <div class="mt-4 text-right">
                <p class="text-xl font-semibold text-gray-800">Total: ${{ number_format($totalAmount, 2) }}</p>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <button wire:click="cancelOrder"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Cancel
                </button>
                <button wire:click="confirmOrder"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Confirm
                </button>
            </div>
        </div>
    </div>
    @endif
</div>