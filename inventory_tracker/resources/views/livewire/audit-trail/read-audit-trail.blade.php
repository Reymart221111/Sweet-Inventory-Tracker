<div class="bg-white shadow-md rounded-lg p-6 space-y-6">

    <!-- Search and Filter Section -->
    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <form wire:submit.prevent="resetFilters" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search Field -->
            <div class="col-span-1 md:col-span-2">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Search</label>
                <div class="relative">
                    <input type="text" id="search" wire:model.debounce.500ms="search"
                        class="w-full px-4 py-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Search by description, model, or action...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Date Range Filters -->
            <div>
                <label for="date_from" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Date
                    From</label>
                <input type="date" id="date_from" wire:model="date_from"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <label for="date_to" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Date To</label>
                <input type="date" id="date_to" wire:model="date_to"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <!-- Reset Button -->
            <div class="col-span-1 md:col-span-4 flex justify-end">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Reset Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Activity Table -->
    <div class="overflow-hidden shadow-lg rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-200">Date</th>
                        <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-200">Model</th>
                        <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-200">Action</th>
                        <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-200">User ID</th>
                        <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-200">Description</th>
                        <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-200">Changes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($activities as $activity)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->created_at->format('M d, Y H:i:s') }}</td>
                        <td class="px-6 py-4">{{ class_basename($activity->subject_type) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full 
                                @if($activity->event === 'created') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                @elseif($activity->event === 'updated') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                @elseif($activity->event === 'deleted') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                @elseif($activity->event === 'attached') bg-violet-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                @endif">
                                {{ $activity->event }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $activity->causer?->id ?? 'System' }}</td>
                        <td class="px-6 py-4">{{ $activity->description ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if($activity->properties->has('old') || $activity->properties->has('attributes'))
                            <details class="group">
                                <summary
                                    class="cursor-pointer text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View Changes
                                </summary>
                                <div class="mt-2 p-4 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                    @if($activity->properties->has('old'))
                                    <div class="mb-3">
                                        <span class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Old:</span>
                                        <pre
                                            class="whitespace-pre-wrap break-words text-xs text-gray-600 dark:text-gray-400">{{ json_encode($activity->properties->get('old', []), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    </div>
                                    @endif

                                    @if($activity->properties->has('attributes'))
                                    <div>
                                        <span class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">New:</span>
                                        <pre
                                            class="whitespace-pre-wrap break-words text-xs text-gray-600 dark:text-gray-400">{{ json_encode($activity->properties->get('attributes', []), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    </div>
                                    @endif
                                </div>
                            </details>
                            @else
                            <span class="text-gray-500 dark:text-gray-400">No changes available</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $activities->links() }}
    </div>

</div>
