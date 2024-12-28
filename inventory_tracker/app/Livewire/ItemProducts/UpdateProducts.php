<?php

namespace App\Livewire\ItemProducts;

use App\Models\ItemCategory;
use App\Models\ItemProducts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class UpdateProducts extends Component
{
    use WithFileUploads;

    public $productId;
    public $name;
    public $image;
    public $price;
    public $based_price;
    public $stocks;
    public $category_id;
    public $search = '';
    public $product;
    public $category;
    public $existingPhotoPath;

    public $availableCategories;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:180', 'min:2', Rule::unique('item_products', 'name')->ignore($this->productId)],
            'image' => 'nullable|image|max:1024',
            'price' => 'required|numeric|min:0',
            'based_price' => 'required|numeric|min:0|',
            'stocks' => 'required|integer|min:0',
            'category_id' => 'required|exists:item_categories,id',
            'search' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'search.required' => 'Category field is required'
        ];
    }

    #[On('updateProduct')]
    public function handleEditProductEvent($recordId)
    {
        $this->productId = $recordId;
        $this->product = ItemProducts::with('category')->find($this->productId);
        $this->name = $this->product->name;
        $this->based_price = $this->product->based_price;
        $this->price = $this->product->price;
        $this->stocks = $this->product->stocks;
        $this->search = $this->product->category->name ?? '';
        $this->category_id = $this->product->category_id;
        $this->existingPhotoPath = $this->product->image_path;
    }

    public function resetValidation($field = null)
    {
        parent::resetValidation($field);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'search') {
            $matchingCategory = collect($this->availableCategories)
                ->firstWhere(fn($category) => strtolower($category['name']) === strtolower($this->search));

            $this->category = $matchingCategory['id'] ?? null;

            if (!$matchingCategory) {
                $this->addError('search', 'Please select a valid category from the list.');
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

    public function updateProduct()
    {
        $product = ItemProducts::findOrFail($this->productId);

        $validatedData = $this->validate();

        try {
            if ($this->image) {
                $file_name = "product-{$product->id}-" . time() . '.' . $this->image->getClientOriginalExtension();
                $path = 'products/';

                Storage::disk('public')->putFileAs(
                    $path,
                    $this->image,
                    $file_name
                );

                $validatedData['image_path'] = $path . $file_name;

                if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                    Storage::disk('public')->delete($product->image_path);
                }
            }

            unset($validatedData['image']);

            $product->update($validatedData);

            $this->dispatch('update-event', [
                'status' => 'success',
                'message' => 'Product Updated Successfully',
            ]);
        } catch (Throwable $th) {
            $this->dispatch('update-event', [
                'status' => 'error',
                'message' => 'Error: ' . $th->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.item-products.update-products');
    }
}
