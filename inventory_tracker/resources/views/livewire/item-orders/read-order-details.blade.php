<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-semibold text-sweetPinkDark">Order List</h1>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 flex space-x-4">
        <!-- Search Form -->
        <form class="flex-1">
            <div class="relative">
                <input type="text" name="search" placeholder="Search orders..." wire:model.live="search"
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
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left bg-sweetPink text-white">
                    <th class="p-3 font-medium">Product Name</th>
                    <th class="p-3 font-medium">Quantity</th>
                    <th class="p-3 font-medium">Unit Price</th>
                    <th class="p-3 font-medium">Total Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($order_details as $order)
                <tr class="bg-white hover:bg-sweetYellowLight">
                    <td class="p-3">
                        <span class="text-sweetPinkDark font-semibold">{{ $order->product->name }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $order->quantity}}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $order->price}}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $order->total_price}}</span>
                    </td>
                </tr>
                </tr>
                @empty
                <tr class="bg-white">
                    <td colspan="6" class="p-4 text-center text-gray-500">No order found.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Pagination (if applicable) -->
    <div class="mt-4 flex justify-center">
        {{ $order_details->links() }}

        <!-- Exit Button with Alpine.js -->
        <button x-data="{ url: '{{ url()->previous() }}' }" @click="window.location.href = url"
            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition-colors flex items-center gap-2 ml-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
            Return To Orders
        </button>
    </div>
</div>