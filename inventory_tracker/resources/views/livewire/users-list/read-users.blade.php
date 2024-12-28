<div class="bg-white p-6 rounded-lg shadow-md" x-data="{ 
    openModal: false,
    openEditModal: false,
     closeModal() {
         this.openModal = false;
        } 
    }">
    <div class="flex items-center justify-between mb-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-semibold text-sweetPinkDark">User Lists</h1>

        <!-- Add Category Button -->
        <button @click="openModal = true"
            class="inline-block px-4 py-2 bg-sweetPink hover:bg-sweetPinkDark text-white rounded shadow transition-colors">
            + Add Users
        </button>
    </div>

    <!-- Session Messages -->
    @include('includes.session-message')

    <!-- Filter Section -->
    <div class="mb-4 flex space-x-4">
        <!-- Search Form -->
        <form class="flex-1">
            <div class="relative">
                <input type="text" name="search" placeholder="Search Users..." wire:model.live="search"
                    class="w-full p-3 pl-10 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                <span class="absolute left-3 top-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M13 7a6 6 0 11-2.367-4.733l3.464 3.464A2 2 0 0013 7zM2 13a6 6 0 118 5.291V17a2 2 0 00-4 0v1.291A5.98 5.98 0 012 13z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
        </form>

        <!-- Role Filter -->
        <div class="flex-1">
            <select wire:model.live="selectedRole"
                class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sweetPinkLight">
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                <option value="{{ $role }}">{{ Str::ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-left bg-sweetPink text-white">
                    <th class="p-3 font-medium">Id</th>
                    <th class="p-3 font-medium">Name</th>
                    <th class="p-3 font-medium">Email</th>
                    <th class="p-3 font-medium">Role</th>
                    <th class="p-3 font-medium w-40">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                <tr class="bg-white hover:bg-sweetYellowLight">
                    <td class="p-3">
                        <span class="text-gray-700">#{{ $user->id }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-sweetPinkDark font-semibold">{{ $user->full_name }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $user->email }}</span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700">{{ $user->role }}</span>
                    </td>
                    <td class="p-3 flex items-center space-x-2">
                        @if ((Auth::user()->role === 'admin' || Auth::user()->role === 'manager') && $user->role === 'admin')
                            <span class="inline-flex items-center px-3 py-1 hover:bg-red-400 bg-gray-500 text-white rounded text-sm">
                                Protected
                            </span>
                        @elseif (Auth::user()->role === 'manager' && $user->role === 'manager')
                            <span class="inline-flex items-center px-3 py-1 hover:bg-red-400 bg-gray-500 text-white rounded text-sm">
                                Protected
                            </span>
                        @else

                        
                            <!-- Edit Action -->
                            <button @click="openEditModal = true"
                                wire:click='$dispatch("updateUser", { "recordId": {{ $user->id }} })'
                                class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm transition-colors">
                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 17h2M12 2v2M4.22 4.22l1.42 1.42M16.64 16.64l1.42 1.42M2 12h2m16 0h2M7.757 7.757l10.486 10.486a1 1 0 01-1.414 1.414L6.343 9.171a1 1 0 011.414-1.414z" />
                                </svg>
                                Edit
                            </button>
                            <!-- Delete Action -->
                            <button wire:click="deleteUser({{ $user->id }})"
                                wire:confirm='Are you sure to delete this record?'
                                class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm transition-colors">
                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="bg-white">
                    <td colspan="6" class="p-4 text-center text-gray-500">No User found.</td>
                </tr>
                @endforelse
            </tbody>
            
        </table>
    </div>


    <!-- Add User Modal -->
    @livewire('users-list.store-users')

    <!-- Update User Modal -->
    @livewire('users-list.update-users')

    <!-- Pagination (if applicable) -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>