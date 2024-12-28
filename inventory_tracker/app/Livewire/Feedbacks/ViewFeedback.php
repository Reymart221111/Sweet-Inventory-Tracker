<?php

namespace App\Livewire\Feedbacks;

use App\Models\Feedback;
use Livewire\Component;

class ViewFeedback extends Component
{
    public $feedback;

    public function mount(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }
    public function render()
    {
        return view('livewire.feedbacks.view-feedback', ['feedback' => $this->feedback]);
    }
}
