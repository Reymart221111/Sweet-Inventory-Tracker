<?php

namespace App\Livewire\ItemOrders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ReadOrders extends Component
{
    use WithPagination;

    public $search;
    public $orderIdSearch; // New property for Order ID search
    public $startDate;
    public $endDate;
    public $specificDate;

    protected $queryString = [
        'search' => ['except' => ''],
        'orderIdSearch' => ['except' => ''], // Include in query string
        'page' => ['except' => ''],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => ''],
        'specificDate' => ['except' => ''],
    ];

    protected $rules = [
        'search' => 'nullable|string|max:255',
        'orderIdSearch' => 'nullable|integer|exists:orders,id', // Validation for Order ID
        'startDate' => 'nullable|date',
        'endDate' => 'nullable|date|after_or_equal:startDate',
        'specificDate' => 'nullable|date',
    ];

    protected $messages = [
        'orderIdSearch.exists' => 'The specified Order ID does not exist.',
        'endDate.after_or_equal' => 'The end date must be a date after or equal to the start date.',
    ];

    // Reset pagination when any filter updates
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingOrderIdSearch()
    {
        $this->resetPage();
    }

    public function updatingStartDate()
    {
        $this->resetPage();
    }

    public function updatingEndDate()
    {
        $this->resetPage();
    }

    public function updatingSpecificDate()
    {
        $this->resetPage();
    }

    // Method to clear all filters
    public function clearFilters()
    {
        $this->reset(['search', 'orderIdSearch', 'startDate', 'endDate', 'specificDate']);
    }

    public function render()
    {
        // Validate the inputs
        $this->validate();

        $orders = Order::query()
            // Filter by Order ID if provided
            ->when($this->orderIdSearch, function ($query) {
                $query->where('id', $this->orderIdSearch);
            })
            // Filter by customer name or contact number if search is provided
            ->when($this->search && !$this->orderIdSearch, function ($query) {
                $query->where(function ($q) {
                    $q->where('customer_name', 'like', "%" . $this->search . "%")
                      ->orWhere('customer_contact_number', 'like', "%" . $this->search . "%");
                });
            })
            // Filter by specific date if provided
            ->when($this->specificDate, function ($query) {
                $query->whereDate('created_at', $this->specificDate);
            }, function ($query) {
                // Only apply date range if specificDate is not set
                if ($this->startDate && $this->endDate) {
                    $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
                }
            })
            ->orderBy('created_at', 'desc') // Optional: Order by latest
            ->paginate(10);

        return view('livewire.item-orders.read-orders', ['orders' => $orders]);
    }
}
