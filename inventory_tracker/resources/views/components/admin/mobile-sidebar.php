<div id="mobile-sidebar" class="fixed inset-0 bg-opacity-50 z-50 hidden transition-opacity duration-300">
        <aside
            class="w-64 bg-white shadow-md min-h-screen p-6 transform translate-x-0 transition-transform duration-300">
            <!-- Close Button -->
            <div class="flex justify-end">
                <button id="close-button" class="text-sweetOrange focus:outline-none" aria-label="Close menu">
                    <!-- Close Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Navigation (Same as Sidebar) -->
            <nav class="mt-8">
                <ul>
                    <li class="mb-4">
                        <a href="#"
                            class="flex items-center p-2 text-gray-700 hover:bg-sweetBlue rounded-lg transition duration-200">
                            <!-- Dashboard Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sweetOrange mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h7v7H3V3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 3h7v7h-7V3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 14h7v7h-7v-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 14h7v7H3v-7z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <!-- Repeat other navigation items similarly -->
                    <!-- ... -->
                </ul>
            </nav>
        </aside>
    </div>