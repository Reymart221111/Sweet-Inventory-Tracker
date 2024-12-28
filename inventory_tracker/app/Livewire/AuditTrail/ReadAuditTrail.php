<?php

namespace App\Http\Livewire;

use App\AuditService as AppAuditService;
use Livewire\Component;
use Livewire\WithPagination;


class ReadAuditTrail extends Component
{
    use WithPagination;

    public $search = '';
    public $date_from = '';
    public $date_to = '';

    protected $auditService;

    // Injecting the AuditService
    public function mount(AppAuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    // Render method to display the data
    public function render()
    {
        // Query to get the audit activities
        $query = $this->auditService->getAllActivities();

        // Search functionality
        if ($this->search) {
            $searchTerm = $this->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('description', 'like', "%{$searchTerm}%")
                  ->orWhere('subject_type', 'like', "%{$searchTerm}%")
                  ->orWhere('event', 'like', "%{$searchTerm}%")
                  ->orWhere('causer_id', 'like', "%{$searchTerm}%");
            });
        }

        // Date range filtering
        if ($this->date_from) {
            $query->whereDate('created_at', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->whereDate('created_at', '<=', $this->date_to);
        }

        // Get paginated data
        $activities = $query->paginate(30);

        return view('livewire.audit-trail.read-audit-trail', [
            'activities' => $activities
        ]);
    }

    // Reset pagination and filters
    public function resetFilters()
    {
        $this->reset(['search', 'date_from', 'date_to']);
        $this->resetPage(); // Reset pagination to page 1
    }
}
