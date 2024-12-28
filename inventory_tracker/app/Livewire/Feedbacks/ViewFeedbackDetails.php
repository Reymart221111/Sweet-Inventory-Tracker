<?php

namespace App\Livewire\Feedbacks;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class ViewFeedbackDetails extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = [
        'feedback_type' => '',
        'priority' => '',
        'sort' => 'latest',
    ];

    protected $queryString = ['search', 'filter']; // For retaining state in the URL

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search is updated
    }

    public function updatingFilter()
    {
        $this->resetPage(); // Reset pagination when filters are updated
    }

    public function deleteFeedback($id)
    {
        $feedback = Feedback::find($id);

        if ($feedback) {
            $feedback->delete();
            session()->flash('success', 'Feedback deleted successfully.');
        } else {
            session()->flash('error', 'Feedback not found.');
        }
    }

    public function render()
    {
        $query = Feedback::query();

        // Apply search functionality
        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('subject', 'like', '%' . $this->search . '%')
                      ->orWhere('message', 'like', '%' . $this->search . '%');
            });
        }

        // Apply filtering for feedback type
        if (!empty($this->filter['feedback_type'])) {
            $query->where('feedback_type', $this->filter['feedback_type']);
        }

        // Apply filtering for priority
        if (!empty($this->filter['priority'])) {
            $query->where('priority', $this->filter['priority']);
        }

        // Apply sorting
        if ($this->filter['sort'] === 'latest') {
            $query->latest();
        } else {
            $query->oldest();
        }

        $feedbacks = $query->paginate(10); // Paginate the results
        return view('livewire.feedbacks.view-feedback-details', ['feedbacks' => $feedbacks]);
    }
}
