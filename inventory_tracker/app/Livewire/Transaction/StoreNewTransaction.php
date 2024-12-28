<?php

namespace App\Livewire\Transaction;

use App\Models\ItemCategory;
use Livewire\Component;
use App\Models\ItemProducts;
use Livewire\WithPagination;

class StoreNewTransaction extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCategory = null;
    public $quantities = []; // Array to store quantities for each product

    // Listener to receive events from other components
    protected $listeners = [
        'stockUpdated' => '$refresh'
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addToCart($productId)
    {
        $quantity = $this->quantities[$productId] ?? 1; // Default to 1 if no quantity is set

        // Validate quantity
        if ($quantity < 1) {
            session()->flash('error', 'Invalid quantity selected.');

            $this->dispatch('error-event', [
                'status' => 'error',
                'message' => 'Invalid quantity selectes.'
            ]);

            return;
        }

        $product = ItemProducts::findOrFail($productId);

        // Check stock availability
        if ($quantity > $product->stocks) {
            session()->flash('error', 'Insufficient stock for this product.');

            $this->dispatch('error-event', [
                'status' => 'error',
                'message' => 'Selected quantity exceeds stock.'
            ]);

            return;
        }

        // Emit event to CartSummary component with product ID and quantity
        $this->dispatch('add-to-cart', [
            'productId' => $productId,
            'quantity' => $quantity
        ]);

        // Optionally, reset the quantity input after adding to cart
        $this->quantities[$productId] = 1;

        session()->flash('success', "{$quantity} x {$product->name} added to carts.");
    }

    public function getProductsProperty()
    {
        $query = ItemProducts::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        $products = $query->paginate(6);

        foreach ($products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }
        }

        return $products;
    }

    public function getCategoriesProperty()
    {
        return ItemCategory::all();
    }

    public function render()
    {
        return view('livewire.transaction.store-new-transaction', [
            'products' => $this->products,
            'categories' => $this->categories
        ]);
    }
}
