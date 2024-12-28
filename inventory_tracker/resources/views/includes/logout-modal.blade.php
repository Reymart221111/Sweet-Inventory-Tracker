<!-- Hidden Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

<!-- Confirmation Modal -->
<div x-show="showLogoutModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-60"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div @click.away="cancelLogout" class="bg-white rounded-lg shadow-lg w-80">
        <div class="px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">Confirm Logout</h2>
            <p class="mt-2 text-gray-600">Are you sure you want to logout?</p>
        </div>
        <div class="px-6 py-4 bg-gray-100 flex justify-end space-x-4">
            <button @click="cancelLogout()" aria-label="Cancel Logout"
                class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded hover:bg-gray-50">
                Cancel
            </button>
            <button @click="confirmLogout()" aria-label="Confirm Logout"
                class="px-4 py-2 bg-blue-600 hover:bg-red-600 text-white rounded">
                Logout
            </button>
        </div>
    </div>
</div>
