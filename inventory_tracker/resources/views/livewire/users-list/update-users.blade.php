<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-show="openEditModal"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
    
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4" x-show="openEditModal"
        @update-event.window="openEditModal = false" x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="scale-100 opacity-100"
        x-transition:leave-end="scale-95 opacity-0">

        <!-- Modal Header -->
        <div class="bg-sweetPink text-white p-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">Add New User</h2>
                <button @click="openEditModal = false" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Form with Alpine.js Data -->
        <form wire:submit.prevent="updateUser" class="p-6 space-y-6" x-data="{ showPassword: false }">
            <div class="grid grid-cols-1 gap-6">
                
                <!-- First Row: First Name and Last Name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-gray-700 font-medium mb-1">First Name</label>
                        <input type="text" name="first_name" id="first_name" wire:model.live="first_name" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('first_name') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-gray-700 font-medium mb-1">Last Name</label>
                        <input type="text" name="last_name" id="last_name" wire:model.live="last_name" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('last_name') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Second Row: Email and Role -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" wire:model.live="email" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-gray-700 font-medium mb-1">Role</label>
                        <select name="role" id="role" wire:model="role" required
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('role') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $roleOption)
                                <option value="{{ $roleOption }}">{{ ucfirst($roleOption) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Third Row: Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                            wire:model.live="password"
                            class="w-full px-3 py-2 rounded-lg border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-600">
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.567-3.683M6.343 6.343a10.05 10.05 0 0111.314 0M17.657 17.657L6.343 6.343" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Modal Actions -->
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" @click="openEditModal = false"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg focus:outline-none transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-sweetPink hover:bg-sweetPinkDark text-white rounded-lg focus:outline-none transition-colors">
                    Save User
                </button>
            </div>
        </form>
    </div>
</div>
