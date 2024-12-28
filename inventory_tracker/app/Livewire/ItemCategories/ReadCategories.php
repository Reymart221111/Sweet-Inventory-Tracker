<?php

namespace App\Livewire\ItemCategories;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ItemCategory;
use Throwable;

class ReadCategories extends Component
{
    use WithPagination;

    // Public property for search input
    public $search = '';

    // Sync 'search' and 'page' with URL query parameters
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    /**
     * Reset pagination when the search term is updated
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Handle events emitted after storing a category
     */
    #[On('store-event')]
    public function handleStoreEvent($event)
    {
        if ($event['status'] === 'success') {
            session()->flash('success', $event['message']);
        } else {
            session()->flash('error', $event['message']);
        }
    }

    #[On('update-event')]
    public function handleUpdateEvent($event)
    {
        if ($event['status'] === 'success') {
            session()->flash('success', $event['message']);
        } else {
            session()->flash('error', $event['message']);
        }
    }

    /**
     * Clear session messages (optional)
     */
    public function clearSession()
    {
        session()->forget(['success', 'error']);
    }

    public function deleteCategory($categoryId)
    {
        $category = ItemCategory::findOrFail($categoryId);

        try {
            $category->delete();

            session()->flash('success', 'Record Deleted Succesfully');
        } catch (Throwable $th) {
            session()->flash('error', 'Error:' . $th->getMessage());
        }
    }

    /**
     * Render the component view with filtered and paginated categories
     */
    public function render()
    {
        $categories = ItemCategory::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.item-categories.read-categories', [
            'categories' => $categories,
        ]);
    }
}
