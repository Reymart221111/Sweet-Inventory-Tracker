<?php

namespace App\Livewire\Feedbacks;

use App\Models\Feedback;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewFeedbackSubmission extends Component
{
    use WithFileUploads;

    public $feedback_type = 'suggestion';
    public $subject = '';
    public $message = '';
    public $priority = 'low';
    public $images = [];
    public $temporaryImages = [];

    protected $rules = [
        'feedback_type' => 'required|string',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'priority' => 'required|string',
        'images.*' => 'image|max:2048', // 2MB limit per image
        'images' => 'array|max:5', // Maximum 5 images
    ];

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048',
            'images' => 'array|max:5',
        ]);

        // Generate temporary URLs for previews
        $this->temporaryImages = [];
        foreach ($this->images as $image) {
            $this->temporaryImages[] = [
                'url' => $image->temporaryUrl(),
                'name' => $image->getClientOriginalName(),
            ];
        }
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
        array_splice($this->temporaryImages, $index, 1);
    }

    public function submit()
    {
        $this->validate();

        // Create feedback entry
        $feedback = Feedback::create([
            'user_id' => Auth::user()->id,
            'feedback_type' => $this->feedback_type,
            'subject' => $this->subject,
            'message' => $this->message,
            'priority' => $this->priority,
        ]);

        // Save uploaded images
        foreach ($this->images as $image) {
            $path = $image->store('feedback-images', 'public');
            \DB::table('feedback_images')->insert([
                'feedback_id' => $feedback->id,
                'image_path' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Reset inputs
        $this->reset(['feedback_type', 'subject', 'message', 'priority', 'images', 'temporaryImages']);
        session()->flash('success', 'Feedback submitted successfully!');
    }

    public function clearSession()
    {
        session()->forget(['success', 'error']);
    }

    public function render()
    {
        return view('livewire.feedbacks.view-feedback-submission');
    }
}
