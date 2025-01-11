<?php

namespace App\Livewire\ItemProducts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ItemCategory;
use App\Models\ItemProducts;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Livewire\Attributes\On;
use Throwable;

class ReadProducts extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $categories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        // Load categories once when component is mounted
        $this->categories = ItemCategory::orderBy('name')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clearSession()
    {
        session()->forget(['success', 'error']);
    }

    #[On('store-event')]
    public function handleStoreEvent($event)
    {
        if ($event['status'] === 'success') {
            session()->flash('success', $event['message']);
            // Refresh categories
            $this->categories = ItemCategory::orderBy('name')->get();
        } else {
            session()->flash('error', $event['message']);
        }
    }

    #[On('update-event')]
    public function handleUpdateEvent($event)
    {
        if ($event['status'] === 'success') {
            session()->flash('success', $event['message']);
            // Refresh categories
            $this->categories = ItemCategory::orderBy('name')->get();
        } else {
            session()->flash('error', $event['message']);
        }
    }

    public function deleteProduct($productId)
    {
        $product = ItemProducts::findOrFail($productId);

        try {
            $product->delete();

            if ($product->image_path && FacadesStorage::disk('public')->exists($product->image_path)) {
                FacadesStorage::disk('public')->delete($product->image_path);
            }

            session()->flash('success', 'Product Deleted Successfully');
        } catch (Throwable $th) {
            session()->flash('error', 'Error: ' . $th->getMessage());
        }
    }

    public function render()
    {
        $products = ItemProducts::with('category')
            ->where('name', 'like', "%{$this->search}%")
            ->when($this->selectedCategory, function ($query) {
                if ($this->selectedCategory) {
                    $query->where('category_id', $this->selectedCategory);
                } else {
                    $query->latest();
                }
            })->paginate(10);

        return view('livewire.item-products.read-products', [
            'products' => $products,
            'categories' => $this->categories,
        ]);
    }
}
