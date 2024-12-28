<?php

namespace App\Livewire\ItemProducts;

use App\Models\ItemCategory;
use App\Models\ItemProducts;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StoreProducts extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $price;
    public $based_price;
    public $stocks;
    public $category_id;
    public $search = '';
    public $category;

    public $availableCategories;

    public function mount()
    {
        $this->availableCategories = ItemCategory::select('id', 'name')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            })
            ->values()
            ->toArray();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:item_products,name',
            'image' => 'nullable|image|max:1024',
            'price' => 'required|numeric|min:0',
            'based_price' => 'required|numeric|min:0|',
            'stocks' => 'required|integer|min:0',
            'category_id' => 'required|exists:item_categories,id',
            'search' => ['required']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'search') {
            $matchingCategory = collect($this->availableCategories)
                ->firstWhere(fn($category) => strtolower($category['name']) === strtolower($this->search));

            $this->category = $matchingCategory['id'] ?? null;

            if (!$matchingCategory) {
                $this->addError('search', 'Please select a valid category id from the list.');
            }
        }

        if ($propertyName === 'price') {
            if (!($this->price > $this->based_price)) {
                $this->addError('price', 'Price must be greater than the based price');
            }
        }
        if ($propertyName === 'based_price') {
            if ($this->price) {
                if (!($this->based_price < $this->price)) {
                    $this->addError('based_price', 'Based price must be less than the price');
                }
            }
        }
    }


    public function storeProduct()
    {
        $this->validate();

        try {
            $imagePath = null;
            if ($this->image) {
                // Create a new product first to get the ID for the image name
                $product = ItemProducts::create([
                    'name' => $this->name,
                    'price' => $this->price,
                    'based_price' => $this->based_price,
                    'stocks' => $this->stocks,
                    'category_id' => $this->category_id,
                ]);

                // Store the image with a custom name using the product ID
                $imagePath = $this->image->storeAs('products', "product-{$product->id}.". $this->image->getClientOriginalExtension(), 'public');

                // Update the product with the image path
                $product->update(['image_path' => $imagePath]);
            } else {
                $product = ItemProducts::create([
                    'name' => $this->name,
                    'price' => $this->price,
                    'based_price' => $this->based_price,
                    'stocks' => $this->stocks,
                    'category_id' => $this->category_id,
                ]);
            }

            $this->reset();

            $this->dispatch('store-event', ['status' => 'success', 'message' => 'Product Added Successfully']);
        } catch (\Throwable $th) {
            $this->dispatch('store-event', ['status' => 'error', 'message' => 'Error: ' . $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.item-products.store-products', ['availableCategories' => $this->availableCategories]);
    }
}
