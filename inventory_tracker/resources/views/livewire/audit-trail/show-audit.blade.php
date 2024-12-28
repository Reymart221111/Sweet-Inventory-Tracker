<div wire:poll.30s class="bg-pink-50 shadow-md rounded-lg p-6 space-y-6">

    <!-- Search and Filter Section -->
    <div class="p-6 bg-pink-100 rounded-lg shadow-lg">
        <form wire:submit.prevent="resetFilters" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Search Field -->
            <div class="col-span-1 md:col-span-2">
                <label for="search" class="block mb-2 text-sm font-semibold text-pink-700">Search</label>
                <div class="relative">
                    <input type="text" id="search" wire:model.live="search"
                        class="w-full px-4 py-3 pl-12 text-sm border border-pink-300 rounded-full focus:ring-2 focus:ring-pink-400 focus:border-pink-400 dark:bg-pink-700 dark:border-pink-600 dark:text-white"
                        placeholder="Search by description, model, or action...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <!-- Sweet-Themed Search Icon (Cupcake) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3c-1.104 0-2 .896-2 2v2m4 0h2a2 2 0 012 2v2a2 2 0 01-2 2h-2m-4 0H6a2 2 0 01-2-2V9a2 2 0 012-2h2m0 0V5a2 2 0 012-2h4a2 2 0 012 2v2m-6 4a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Date Range Filters -->
            <div>
                <label for="date_from" class="block mb-2 text-sm font-semibold text-pink-700">Date From</label>
                <input type="date" id="date_from" wire:model.live="date_from"
                    class="w-full px-4 py-3 text-sm border border-pink-300 rounded-full focus:ring-2 focus:ring-pink-400 focus:border-pink-400 dark:bg-pink-700 dark:border-pink-600 dark:text-white">
            </div>
            <div>
                <label for="date_to" class="block mb-2 text-sm font-semibold text-pink-700">Date To</label>
                <input type="date" id="date_to" wire:model.live="date_to"
                    class="w-full px-4 py-3 text-sm border border-pink-300 rounded-full focus:ring-2 focus:ring-pink-400 focus:border-pink-400 dark:bg-pink-700 dark:border-pink-600 dark:text-white">
            </div>

            <!-- Reset Button -->
            <div class="col-span-1 md:col-span-4 flex justify-end">
                <button type="submit"
                    class="px-6 py-3 text-sm font-semibold text-white bg-pink-600 rounded-full hover:bg-pink-700 focus:ring-4 focus:ring-pink-300 transition">
                    Reset Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Activity Table -->
    <div class="overflow-hidden shadow-lg rounded-lg bg-pink-50">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-pink-200 dark:bg-pink-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-pink-800 dark:text-pink-300">Date</th>
                        <th class="px-6 py-4 font-semibold text-pink-800 dark:text-pink-300">Model</th>
                        <th class="px-6 py-4 font-semibold text-pink-800 dark:text-pink-300">Action</th>
                        <th class="px-6 py-4 font-semibold text-pink-800 dark:text-pink-300">User ID</th>
                        <th class="px-6 py-4 font-semibold text-pink-800 dark:text-pink-300">Description</th>
                        <th class="px-6 py-4 font-semibold text-pink-800 dark:text-pink-300">Changes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-200 dark:divide-pink-700">
                    @forelse($activities as $activity)
                        <tr class="bg-pink-50 dark:bg-pink-800 hover:bg-pink-100 dark:hover:bg-pink-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-pink-600 dark:text-pink-200">{{ $activity->created_at->format('M d, Y H:i:s') }}</td>
                            <td class="px-6 py-4 text-pink-600 dark:text-pink-200">{{ class_basename($activity->subject_type) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($activity->event === 'created') bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @elseif($activity->event === 'updated') bg-blue-200 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                    @elseif($activity->event === 'deleted') bg-red-400 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @elseif($activity->event === 'attached') bg-violet-200 text-violet-800 dark:bg-violet-900 dark:text-violet-300
                                    @endif">
                                    {{ ucfirst($activity->event) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-pink-600 dark:text-pink-200">{{ $activity->causer?->id ?? 'System' }}</td>
                            <td class="px-6 py-4 text-pink-600 dark:text-pink-200">{{ $activity->description ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                @if($activity->properties->has('old') || $activity->properties->has('attributes'))
                                    <details class="group">
                                        <summary
                                            class="cursor-pointer text-pink-600 hover:text-pink-800 dark:text-pink-400 dark:hover:text-pink-300">
                                            View Changes
                                        </summary>
                                        <div class="mt-2 p-4 bg-pink-100 dark:bg-pink-900 rounded-lg">
                                            @if($activity->properties->has('old'))
                                                <div class="mb-3">
                                                    <span class="block font-semibold mb-2 text-pink-700 dark:text-pink-300">Old:</span>
                                                    <pre
                                                        class="whitespace-pre-wrap break-words text-xs text-pink-600 dark:text-pink-400">{{ json_encode($activity->properties->get('old', []), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                </div>
                                            @endif

                                            @if($activity->properties->has('attributes'))
                                                <div>
                                                    <span class="block font-semibold mb-2 text-pink-700 dark:text-pink-300">New:</span>
                                                    <pre
                                                        class="whitespace-pre-wrap break-words text-xs text-pink-600 dark:text-pink-400">{{ json_encode($activity->properties->get('attributes', []), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                </div>
                                            @endif
                                        </div>
                                    </details>
                                @else
                                    <span class="text-pink-500 dark:text-pink-400">No changes available</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-pink-500 dark:text-pink-400">
                                No audit logs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $activities->links() }}
    </div>

</div>
