<header class="bg-sweetPink w-full py-2 px-2 flex justify-between items-center shadow-md">
    <div class="flex items-center">
        <!-- Sidebar Toggle Button -->
        <button id="sidebarToggle" class="mr-4 md:block hidden text-white focus:outline-none focus:ring-2 focus:ring-white"
            aria-expanded="true" aria-controls="sidebar">
            <!-- Hamburger Icon -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
    <h2 class="text-xl md:text-2xl font-semibold text-white">@yield('content-title')</h2>
    <!-- User Profile -->
    @include('includes.user-profile')
</header>
