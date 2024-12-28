<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Account Settings</h2>

    <!-- Success Session Message -->
    @include('includes.session-message')


    <form wire:submit.prevent='updateAccount'>
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700">First Name</label>
            <input type="text" name="first_name" id="first_name" wire:model.live="first_name"
                class="w-full mt-2 p-3 border @error('first_name') border-red-500 @else border-gray-300 @enderror rounded-lg"
                required>
            @error('first_name')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="last_name" class="block text-gray-700">Last Name</label>
            <input type="text" name="last_name" id="last_name" wire:model.live="last_name"
                class="w-full mt-2 p-3 border @error('last_name') border-red-500 @else border-gray-300 @enderror rounded-lg"
                required>
            @error('last_name')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" wire:model.live='email'
                class="w-full mt-2 p-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg"
                required>
            @error('email')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="w-full py-3 bg-sweetPink text-white rounded-lg">Save Changes</button>
    </form>
</div>