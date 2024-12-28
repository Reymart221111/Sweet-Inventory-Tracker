<?php

namespace App\Livewire\AuditTrail;

use App\AuditService;
use App\Services\AuditService as ServicesAuditService;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ShowAudit extends Component
{
    use WithPagination;

    public $search = '';
    public $date_from = '';
    public $date_to = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'date_from' => ['except' => ''],
        'date_to' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {

        $query = Activity::query();


        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('description', 'like', $searchTerm)
                    ->orWhere('subject_type', 'like', $searchTerm)
                    ->orWhere('event', 'like', $searchTerm)
                    ->orWhere('causer_id', 'like', $searchTerm);
            });
        }


        if ($this->date_from) {
            $query->whereDate('created_at', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->whereDate('created_at', '<=', $this->date_to);
        }


        $query->orderBy('created_at', 'desc');


        $activities = $query->paginate(30);

        return view('livewire.audit-trail.show-audit', [
            'activities' => $activities
        ]);
    }


    public function resetFilters()
    {
        $this->reset(['search', 'date_from', 'date_to']);
        $this->resetPage();
    }
}
