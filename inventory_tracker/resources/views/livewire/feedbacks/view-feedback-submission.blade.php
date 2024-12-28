<div class="max-w-2xl mx-auto">
    <div class="p-8 bg-pink-50 rounded-xl shadow-lg">
        <h3 class="mb-8 text-2xl font-bold text-pink-700">Submit Your Feedback</h3>

        <form wire:submit.prevent="submit">
            <!-- Feedback Type -->
            <div class="mb-6">
                <label for="feedback_type" class="block mb-2 text-sm font-medium text-pink-700">
                    Feedback Type
                </label>
                <select id="feedback_type" wire:model="feedback_type"
                    class="w-full px-4 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
                    <option value="suggestion">Suggestion</option>
                    <option value="complaint">Complaint</option>
                    <option value="bug_report">Bug Report</option>
                    <option value="other">Other</option>
                </select>
                @error('feedback_type')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Subject -->
            <div class="mb-6">
                <label for="subject" class="block mb-2 text-sm font-medium text-pink-700">
                    Subject
                </label>
                <input type="text" id="subject" wire:model="subject"
                    class="w-full px-4 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400 transition"
                    placeholder="Brief description of your feedback">
                @error('subject')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Feedback Message -->
            <div class="mb-6">
                <label for="message" class="block mb-2 text-sm font-medium text-pink-700">
                    Your Feedback
                </label>
                <textarea id="message" wire:model="message" rows="6"
                    class="w-full px-4 py-2 border border-pink-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-pink-400 transition"
                    placeholder="Please provide detailed feedback..."></textarea>
                @error('message')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Priority Level -->
            <div class="mb-6">
                <label for="priority" class="block mb-2 text-sm font-medium text-pink-700">
                    Priority Level
                </label>
                <select id="priority" wire:model="priority"
                    class="w-full px-4 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="urgent">Urgent</option>
                </select>
                @error('priority')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Multiple Image Upload -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-pink-700">
                    Attach Images (Optional)
                </label>
                <div class="relative" x-data="{ isDropping: false }" x-on:dragover.prevent="isDropping = true"
                    x-on:dragleave.prevent="isDropping = false" x-on:drop.prevent="isDropping = false"
                    :class="{ 'border-pink-400 bg-pink-100': isDropping, 'border-pink-300 bg-pink-50': !isDropping }"
                    class="border-2 border-dashed rounded-xl p-6 transition-colors duration-300">

                    <input type="file" id="images" wire:model="images" multiple accept="image/*" class="hidden">
                    <label for="images" class="flex flex-col items-center justify-center cursor-pointer">
                        <div class="flex items-center justify-center w-16 h-16 mb-4 bg-pink-200 rounded-full">
                            <!-- Sweet-Themed Upload Icon (Cupcake) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pink-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4c-1.104 0-2 .896-2 2v4a2 2 0 104 0V6c0-1.104-.896-2-2-2zM5 14h14M12 14v6m-3-3h6" />
                            </svg>
                        </div>
                        <p class="text-sm text-pink-600">Click to upload images or drag and drop</p>
                        <p class="text-xs text-pink-400">Maximum 5 images (2MB each)</p>
                    </label>
                </div>
                @error('images.*')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror

                <!-- Image Preview -->
                @if(count($temporaryImages) > 0)
                <div class="grid grid-cols-2 gap-4 mt-4">
                    @foreach($temporaryImages as $index => $image)
                    <div class="relative group">
                        <div class="relative aspect-w-3 aspect-h-2">
                            <img src="{{ $image['url'] }}" class="object-cover w-full h-40 rounded-xl">
                            <button type="button" wire:click="removeImage({{ $index }})"
                                class="absolute top-2 right-2 p-2 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center px-6 py-3 text-white bg-pink-600 rounded-full hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400 transition"
                    wire:loading.attr="disabled" wire:loading.class="opacity-50">
                    <span wire:loading.remove>Submit Feedback</span>
                    <span wire:loading class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Submitting...
                    </span>
                </button>
            </div>
        </form>

        <!-- Success Message -->
        <div class="mt-6">
            @include('includes.session-message')
        </div>
    </div>
</div>