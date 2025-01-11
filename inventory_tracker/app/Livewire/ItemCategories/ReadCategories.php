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

    public $search = '';
    public $page = 1;
    private $cacheKey;
    
    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->updateCacheKey();
    }

    private function updateCacheKey()
    {
        $this->cacheKey = 'categories_' . md5($this->search . $this->page);
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->updateCacheKey();
    }

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

    public function clearSession()
    {
        session()->forget(['success', 'error']);
    }

    public function deleteCategory($categoryId)
    {
        $category = ItemCategory::findOrFail($categoryId);

        try {
            $category->delete();
            $this->updateCacheKey();
            cache()->forget($this->cacheKey);
            session()->flash('success', 'Record Deleted Successfully');
        } catch (Throwable $th) {
            session()->flash('error', 'Error:' . $th->getMessage());
        }
    }

    public function render()
    {
        $this->updateCacheKey();
        
        $categories = cache()->remember($this->cacheKey, 60*60, function () {
            return ItemCategory::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy('name', 'asc')
                ->paginate(10);
        });

        return view('livewire.item-categories.read-categories', [
            'categories' => $categories,
        ]);
    }
}