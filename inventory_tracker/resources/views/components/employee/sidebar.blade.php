<nav>
    <ul>
        <!-- Transact Orders (POS) -->
        <li class="mb-4">
            <a href="{{ route('employee.pos') }}"
                class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('employee.pos') }}">
                <!-- POS Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 16c-3.33 0-6 2.67-6 6h12c0-3.33-2.67-6-6-6z" />
                </svg>
                <span class="ml-3 sidebar-text">Transact Orders</span>
            </a>
        </li>

        <!-- Items -->
        <li class="mb-4">
            <a href="{{ route('employee.item-products') }}"
                class="flex items-center p-2 text-gray-700 transition duration-200 hover:bg-sweetBlue {{ isActive('employee.item-products') }}">
                <!-- Products Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-2 9m5-9v9m4-9v9m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4h6z" />
                </svg>
                <span class="ml-3 sidebar-text">Items</span>
            </a>
        </li>

        <!-- User Feedbacks -->
        <li class="mb-4">
            <a href="{{ route('employee.submit-feedback') }}"
                class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('employee.submit-feedback') }}">
                <!-- Feedback Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.003 9.003 0 01-9-9c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="ml-3 sidebar-text">Submit Feedbacks</span>
            </a>
        </li>

    </ul>
</nav>