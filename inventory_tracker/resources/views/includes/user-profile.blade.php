<div x-data="{ open: false }" class="relative">

    <!-- Dropdown Trigger -->
    <div @click="open = !open" class="flex items-center space-x-4 cursor-pointer">
        <span class="text-gray-700 text-sm md:text-base">{{ Auth::user()->full_name }}</span>
        <img src="{{ Auth::user()->profile_path ? asset('storage/' . Auth::user()->profile_path) : asset('storage/uploads/no-photo/no-photo.png') }}"
            alt="User Avatar" class="w-8 h-8 md:w-10 md:h-10 rounded-full">
    </div>

    <!-- Dropdown Menu -->
    <div x-show="open" x-cloak @click.outside="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 z-50">

        <div class="px-4 py-3 border-b border-gray-100">
            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->full_name }}</p>
            <p class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</p>
        </div>

        <div class="py-1">
            @php
            $rolePrefix = '';
            if (Auth::user()->role === 'admin') {
              $rolePrefix = 'admin';
            } elseif (Auth::user()->role === 'manager') {
             $rolePrefix = 'manager';
            } elseif (Auth::user()->role === 'employee') {
              $rolePrefix = 'employee';
            }
            @endphp

            <a href="{{ route($rolePrefix . '.accounts.settings') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Account Settings
            </a>
            <a href="{{ route($rolePrefix . '.accounts.password') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Update Password
            </a>
            <a href="{{ route($rolePrefix . '.accounts.profile') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Update Profile Photo
            </a>
        </div>

        <div class="border-t border-gray-100">
            <!-- Logout Button triggers confirmation modal -->
            <button onclick="openModal()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                Logout
            </button>
        </div>
    </div>
</div>