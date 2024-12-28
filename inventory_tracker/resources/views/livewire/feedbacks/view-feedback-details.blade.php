<div class="max-w-7xl mx-auto p-6 bg-pink-50">
    <h1 class="text-3xl font-extrabold text-pink-700 mb-6">Submitted Feedback</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Search and Filter Section -->
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
            <!-- Search Bar -->
            <div class="relative w-full md:w-1/3">
                <input type="text" wire:model.live="search" placeholder="Search feedback..."
                    class="w-full px-4 py-3 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400" />
                <span class="absolute inset-y-0 right-4 flex items-center">
                    <!-- Sweet-Themed Search Icon (Optional: Replace with a cupcake or candy icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
            </div>

            <!-- Advanced Filters -->
            <div class="mt-4 md:mt-0 flex space-x-4">
                <select wire:model.live="filter.feedback_type"
                    class="px-4 py-2 border border-pink-300 rounded-full bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="">All Types</option>
                    <option value="suggestion">Suggestion</option>
                    <option value="complaint">Complaint</option>
                    <option value="bug_report">Bug Report</option>
                    <option value="other">Other</option>
                </select>

                <select wire:model.live="filter.priority"
                    class="px-4 py-2 border border-pink-300 rounded-full bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="">All Priorities</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="urgent">Urgent</option>
                </select>

                <select wire:model.live="filter.sort"
                    class="px-4 py-2 border border-pink-300 rounded-full bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="latest">Latest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="overflow-hidden rounded-lg border border-pink-200 shadow-md">
            <table class="min-w-full bg-white">
                <thead class="bg-pink-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-pink-700">Feedback ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-pink-700">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-pink-700">Subject</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-pink-700">Priority</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-pink-700">Date</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-pink-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm text-pink-600">{{ $feedback->id }}</td>
                        <td class="px-6 py-4 text-sm text-pink-600">{{ ucfirst($feedback->feedback_type) }}</td>
                        <td class="px-6 py-4 text-sm text-pink-600">{{ $feedback->subject }}</td>
                        <td class="px-6 py-4 text-sm text-pink-600">
                            <span class="px-3 py-1 text-xs font-semibold text-white rounded-full
                                    @if($feedback->priority === 'low') bg-green-400
                                    @elseif($feedback->priority === 'medium') bg-yellow-400
                                    @elseif($feedback->priority === 'high') bg-orange-400
                                    @elseif($feedback->priority === 'urgent') bg-red-400
                                    @endif">
                                {{ ucfirst($feedback->priority) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-pink-600">{{ $feedback->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-center flex justify-center space-x-4">
                            <!-- View Button -->
                            <a href="{{ route('admin.feedbacks.view', ['feedback' => $feedback->id]) }}"
                                class="text-purple-600 hover:text-purple-800 focus:outline-none" title="View Feedback">
                                <!-- Cupcake Icon as a Sweet-Themed View Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path d="M12 2a6 6 0 00-6 6c0 3.73 2.74 6.8 6 7.92V22h2v-6.08c3.26-1.12 6-4.19 6-7.92a6 6 0 00-6-6z" />
                                    <path d="M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </a>

                            <!-- Delete Button -->
                            <button wire:click="deleteFeedback({{ $feedback->id }})"
                                wire:confirm='Are you sure you want to delete this feedback?'
                                class="text-red-600 hover:text-red-800 focus:outline-none" title="Delete Feedback">
                                <!-- Candy Trash Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-pink-500">
                            No feedback found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
