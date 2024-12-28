<div id="logoutModal"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl p-6 w-96 transform transition-all duration-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Confirm Logout</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to log out of your account?</p>
        <div class="flex justify-end space-x-4">
            <button onclick="closeModal()"
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                Cancel
            </button>
            <form wire:submit.prevent='logout'>
                <button
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>