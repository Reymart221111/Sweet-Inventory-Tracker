<div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-xl ring-1 ring-gray-200">
    <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Feedback Details</h2>
    </div>

    <div class="space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-1">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Submitted By</h3>
                <p class="text-lg font-medium text-gray-900 bg-gray-50 p-3 rounded-lg">
                    {{ $feedback->user->email }}
                </p>
            </div>

            <div class="col-span-1">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Feedback Type</h3>
                <p class="text-lg font-medium text-blue-700 bg-blue-50 p-3 rounded-lg capitalize">
                    {{ $feedback->feedback_type }}
                </p>
            </div>

            <div class="col-span-1">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Priority</h3>
                <p class="text-lg font-medium 
                    @if($feedback->priority == 'urgent') text-red-700 bg-red-50
                    @elseif($feedback->priority == 'high') text-orange-700 bg-orange-50
                    @elseif($feedback->priority == 'medium') text-yellow-700 bg-yellow-50
                    @else text-green-700 bg-green-50
                    @endif 
                    p-3 rounded-lg capitalize">
                    {{ $feedback->priority }}
                </p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Subject</h3>
            <p class="text-xl font-semibold text-gray-800">{{ $feedback->subject }}</p>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Message</h3>
            <p class="text-base text-gray-700 leading-relaxed">{{ $feedback->message }}</p>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Attached Images</h3>
            @if($feedback->images->count())
            <div class="grid grid-cols-3 gap-6">
                @foreach($feedback->images as $image)
                <div class="relative group overflow-hidden rounded-2xl shadow-lg">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Feedback Image"
                        class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500">
                No images attached.
            </div>
            @endif
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button x-data @click="window.history.back()"
            class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            <span>Back to Feedback List</span>
        </button>
    </div>
</div>