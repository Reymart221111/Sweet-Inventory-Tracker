<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Change Password</h2>

    <!-- Success Session Message -->
    @include('includes.session-message')

    <form wire:submit.prevent='updatePassword'>
        <!-- Old Password Field -->
        <div class="mb-4" x-data="{ showOldPassword: false }">
            <label for="old_password" class="block text-gray-700">Old Password</label>
            <div class="relative mt-2">
                <input :type="showOldPassword ? 'text' : 'password'" name="old_password" id="old_password"
                    wire:model.defer='old_password'
                    class="w-full p-3 border @error('old_password') border-red-500 @else border-gray-300 @enderror rounded-lg"
                    required>
                <button type="button" @click="showOldPassword = !showOldPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 focus:outline-none">
                    <!-- Eye Icon -->
                    <svg x-show="!showOldPassword" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Eye Closed Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-2.05.62-3.953 1.688-5.563M4.22 4.22l15.56 15.56M9.88 9.88a3 3 0 004.24 4.24" />
                    </svg>
                    <svg x-show="showOldPassword" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Eye Open Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.294 5 12 5c2.144 0 4.125.756 5.722 2" />
                    </svg>
                </button>
            </div>
            @error('old_password')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password Field -->
        <div class="mb-4" x-data="{ showNewPassword: false }">
            <label for="new_password" class="block text-gray-700">New Password</label>
            <div class="relative mt-2">
                <input :type="showNewPassword ? 'text' : 'password'" name="new_password" id="new_password"
                    wire:model.live='new_password'
                    class="w-full p-3 border @error('new_password') border-red-500 @else border-gray-300 @enderror rounded-lg"
                    required>
                <button type="button" @click="showNewPassword = !showNewPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 focus:outline-none">
                    <!-- Eye Icon -->
                    <svg x-show="!showNewPassword" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Eye Closed Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-2.05.62-3.953 1.688-5.563M4.22 4.22l15.56 15.56M9.88 9.88a3 3 0 004.24 4.24" />
                    </svg>
                    <svg x-show="showNewPassword" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Eye Open Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.294 5 12 5c2.144 0 4.125.756 5.722 2" />
                    </svg>
                </button>
            </div>
            @error('new_password')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="mb-4" x-data="{ showConfirmPassword: false }">
            <label for="confirm_password" class="block text-gray-700">Confirm New Password</label>
            <div class="relative mt-2">
                <input :type="showConfirmPassword ? 'text' : 'password'" name="confirm_password" id="confirm_password"
                    wire:model.live='confirm_password'
                    class="w-full p-3 border @error('confirm_password') border-red-500 @else border-gray-300 @enderror rounded-lg"
                    required>
                <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 focus:outline-none">
                    <!-- Eye Icon -->
                    <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Eye Closed Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-2.05.62-3.953 1.688-5.563M4.22 4.22l15.56 15.56M9.88 9.88a3 3 0 004.24 4.24" />
                    </svg>
                    <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <!-- Eye Open Icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.294 5 12 5c2.144 0 4.125.756 5.722 2" />
                    </svg>
                </button>
            </div>
            @error('confirm_password')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-4">
            <!-- Submit Button -->
            <button type="submit" class="flex-1 py-3 bg-sweetPink text-white rounded-lg hover:bg-pink-600 transition duration-200">
                Update Password
            </button>
            <!-- Clear Button -->
            <button type="button" wire:click="resetForm" class="flex-1 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200">
                Clear
            </button>
        </div>
    </form>
</div>
