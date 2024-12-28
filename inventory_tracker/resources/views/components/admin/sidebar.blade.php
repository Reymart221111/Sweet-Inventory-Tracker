<nav>
  <ul>
    <!-- Dashboard -->
    <li class="mb-4">
      <a href="{{ route('admin.dashboard') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.dashboard') }}">
        <!-- Dashboard Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM14 14h7v7h-7v-7zM3 14h7v7H3v-7z" />
        </svg>
        <span class="ml-3 sidebar-text">Dashboard</span>
      </a>
    </li>

    <!-- Item Categories -->
    <li class="mb-4">
      <a href="{{ route('admin.item-categories') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.item-categories') }}">
        <!-- Categories Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
        </svg>
        <span class="ml-3 sidebar-text">Item Categories</span>
      </a>
    </li>

    <!-- Items -->
    <li class="mb-4">
      <a href="{{ route('admin.item-products') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 hover:bg-sweetBlue {{ isActive('admin.item-products') }}">
        <!-- Products Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-2 9m5-9v9m4-9v9m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4h6z" />
        </svg>
        <span class="ml-3 sidebar-text">Items</span>
      </a>
    </li>

    <!-- Orders -->
    <li class="mb-4">
      <a href="{{ route('admin.orders.index') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.orders*') }}">
        <!-- Orders Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438z" />
        </svg>
        <span class="ml-3 sidebar-text">Orders</span>
      </a>
    </li>

    <!-- Transact Orders (POS) -->
    <li class="mb-4">
      <a href="{{ route('admin.pos') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.pos') }}">
        <!-- POS Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
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

    <!-- Users -->
    <li class="mb-4">
      <a href="{{ route('admin.users') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.users') }}">
        <!-- Users Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 16c-3.33 0-6 2.67-6 6h12c0-3.33-2.67-6-6-6z" />
        </svg>
        <span class="ml-3 sidebar-text">Users</span>
      </a>
    </li>

    <!-- User Feedbacks -->
    <li class="mb-4">
      <a href="{{ route('admin.feedbacks.index') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.feedbacks*') }}">
        <!-- Feedback Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.003 9.003 0 01-9-9c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <span class="ml-3 sidebar-text">User Feedbacks</span>
      </a>
    </li>

    <!-- Audit Logs -->
    <li class="mb-4">
      <a href="{{ route('admin.audit') }}"
        class="flex items-center p-2 text-gray-700 transition duration-200 {{ isActive('admin.audit*') }}">
        <!-- Audit Logs Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438z" />
        </svg>
        <span class="ml-3 sidebar-text">Audit Logs</span>
      </a>
    </li>
  </ul>
</nav>
