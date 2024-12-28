<div class="container mx-auto px-4 py-6">
    <!-- Existing Metrics Grid -->

    @php
    $rolePrefix = '';
    if(Auth::user()->role === 'admin')
    {
    $rolePrefix = 'admin';
    } elseif (Auth::user()->role === 'manager') {
    $rolePrefix = 'manager';
    }
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Active Products -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-teal-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Active Products</p>
                    <p class="text-xl font-semibold text-gray-700">{{ $activeProducts }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.item-products')}}"
                class="mt-2 w-full bg-teal-500 text-white py-2 rounded-md text-center hover:bg-teal-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Low Stock -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-sweetBlue rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Low Stock</p>
                    <p class="text-xl font-semibold text-gray-700">{{ $lowStockProducts }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.item-products')}}"
                class="mt-2 w-full bg-sweetBlue text-white py-2 rounded-md text-center hover:bg-blue-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Recent Additions -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-sweetPink rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Recent Additions</p>
                    <p class="text-xl font-semibold text-gray-700">{{ $recentProducts }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.item-products')}}"
                class="mt-2 w-full bg-sweetPink text-white py-2 rounded-md text-center hover:bg-pink-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Sold Items -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-green-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Sold Items</p>
                    <p class="text-xl font-semibold text-gray-700">{{ $soldItems }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.item-products')}}"
                class="mt-2 w-full bg-green-500 text-white py-2 rounded-md text-center hover:bg-green-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Total Revenue -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-purple-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-xl font-semibold text-gray-700">${{ $totalRevenue }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.orders.index')}}"
                class="mt-2 w-full bg-purple-500 text-white py-2 rounded-md text-center hover:bg-purple-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Number of Orders -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-orange-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Number of Orders</p>
                    <p class="text-xl font-semibold text-gray-700">{{ $numberOfOrders }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.orders.index')}}"
                class="mt-2 w-full bg-orange-500 text-white py-2 rounded-md text-center hover:bg-orange-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Zero Stock Products -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-red-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.657l3.536 3.536M9.172 9.172L5.636 5.636m3.536 3.536l2.828 2.828m-5.657 5.657l3.536-3.536m-3.536-3.536l5.657-5.657" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Zero Stock Products</p>
                    <p class="text-xl font-semibold text-gray-700">{{ $zeroStockProducts }}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.item-products')}}"
                class="mt-2 w-full bg-red-500 text-white py-2 rounded-md text-center hover:bg-red-600 transition duration-300">
                View
            </a>
        </div>

        <!-- Total Earnings -->
        <div
            class="bg-white shadow-md rounded-lg p-4 md:p-6 flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-yellow-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M17 15l2.386 2.386A4.008 4.008 0 0121 19.5V22H3v-2.5a4.009 4.009 0 011.614-3.114L7 15h10z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Earnings</p>
                    <p class="text-xl font-semibold text-gray-700">${{$totalEarnings}}</p>
                </div>
            </div>
            <!-- View Button -->
            <a href="{{route($rolePrefix . '.orders.index')}}"
                class="mt-2 w-full bg-yellow-500 text-white py-2 rounded-md text-center hover:bg-yellow-600 transition duration-300">
                View
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex space-x-6">
            <!-- First Chart with Border -->
            <div class="flex-1 border p-4 rounded-lg">
                @livewire('charts.sample-chart')
            </div>

            <!-- Second Chart with Border -->
            <div class="flex-1 border p-4 rounded-lg">
                @livewire('charts.sales-chart')
            </div>
        </div>
    </div>


</div>