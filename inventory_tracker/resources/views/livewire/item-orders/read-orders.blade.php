<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-semibold text-sweetPinkDark">Order List</h1>
    </div>

    <!-- Filter Section -->
    <div class="mb-6">
        <!-- Row 1: Order ID and Customer Search -->
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
            <!-- Order ID Search Input -->
            <div class="flex-1 md:w-1/4">
                <div class="relative">
                    <input
                        type="number"
                        name="orderIdSearch"
                        placeholder="Search by Order ID..."
                       wire:model.live="orderIdSearch"
                        class="w-full p-3 pl-10 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sweetPinkLight"
                    >
                    <span class="absolute left-3 top-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2v1h4v-1c0-1.104-.896-2-2-2zM5 12a7 7 0 1114 0 7 7 0 01-14 0z" />
                        </svg>
                    </span>
                </div>
                @error('orderIdSearch') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Customer Search Input -->
            <div class="flex-1 md:w-3/4">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search customers..."
                       wire:model.live="search"
                        class="w-full p-3 pl-10 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sweetPinkLight"
                    >
                    <span class="absolute left-3 top-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M13 7a6 6 0 11-2.367-4.733l3.464 3.464A2 2 0 0013 7zM2 13a6 6 0 118 5.291V17a2 2 0 00-4 0v1.291A5.98 5.98 0 012 13z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                @error('search') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>
        </div>

        <!-- Row 2: Date Filters and Clear Filters Button -->
        <div class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
            <!-- Specific Date Filter -->
            <div class="flex flex-col md:w-1/4">
                <label for="specificDate" class="text-sm font-medium text-gray-700">Specific Date:</label>
                <input
                    type="date"
                    id="specificDate"
                   wire:model.live="specificDate"
                    class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-sweetPinkLight"
                />
                @error('specificDate') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Start Date Filter -->
            <div class="flex flex-col md:w-1/4">
                <label for="startDate" class="text-sm font-medium text-gray-700">Start Date:</label>
                <input
                    type="date"
                    id="startDate"
                   wire:model.live="startDate"
                    class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-sweetPinkLight"
                />
                @error('startDate') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- End Date Filter -->
            <div class="flex flex-col md:w-1/4">
                <label for="endDate" class="text-sm font-medium text-gray-700">End Date:</label>
                <input
                    type="date"
                    id="endDate"
                   wire:model.live="endDate"
                    class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-sweetPinkLight"
                />
                @error('endDate') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Clear Filters Button -->
            <div class="flex items-end md:w-1/4">
                <button
                    type="button"
                    wire:click="clearFilters"
                    class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-red-400"
                >
                    Clear Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Validation Errors (Global) -->
    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Orders Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left bg-sweetPink text-white">
                    <th class="p-3 font-medium">Order Id</th>
                    <th class="p-3 font-medium">Customer Name</th>
                    <th class="p-3 font-medium">Customer Contact Number</th>
                    <th class="p-3 font-medium">Total Amount</th>
                    <th class="p-3 font-medium">Order Date</th>
                    <th class="p-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($orders as $order)
                    <tr class="bg-white hover:bg-sweetYellowLight">
                        <td class="p-3">
                            <span class="text-gray-700">#{{ $order->id }}</span>
                        </td>
                        <td class="p-3">
                            <span class="text-sweetPinkDark font-semibold">
                                {{ $order->customer_name ?: "Not Provided" }}
                            </span>
                        </td>
                        <td class="p-3">
                            <span class="text-gray-700">
                                {{ $order->customer_contact_number ?: "Not Provided" }}
                            </span>
                        </td>
                        <td class="p-3">
                            <span class="text-gray-700">${{ number_format($order->total_amount, 2) }}</span>
                        </td>
                        <td class="p-3">
                            <span class="text-gray-700">{{ $order->created_at->format('M d, Y H:i:s') }}</span>
                        </td>
                        <td class="p-3 flex space-x-2">
                            @php
                                $rolePrefix = '';
                                if(Auth::user()->role === 'admin') {
                                    $rolePrefix = 'admin';
                                } elseif(Auth::user()->role === 'manager') {
                                    $rolePrefix = 'manager';
                                }
                            @endphp
                            <!-- View Action -->
                            <a href="{{ route($rolePrefix . '.orders.show', $order->id) }}"
                                class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm transition-colors">
                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 17h2M12 2v2M4.22 4.22l1.42 1.42M16.64 16.64l1.42 1.42M2 12h2m16 0h2M7.757 7.757l10.486 10.486a1 1 0 01-1.414 1.414L6.343 9.171a1 1 0 011.414-1.414z" />
                                </svg>
                                View Order
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="6" class="p-4 text-center text-gray-500">No order found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
