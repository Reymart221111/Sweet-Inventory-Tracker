<?php

namespace App\Livewire\ItemCategories;

use App\Models\ItemCategory;
use Livewire\Component;
use Throwable;

class StoreCategories extends Component
{
    public $name;
    public $description;


    public function rules()
    {
        return [
            'name' => ['unique:item_categories', 'required', 'string', 'max:180', 'min:4'],
            'description' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Category name already exist.',
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be a string.',
            'name.min' => 'Category name must contain 4 characters.'
        ];
    }

    public function updated($propertyName)
    {
        return $this->validateOnly($propertyName);
    }

    public function storeCategory()
    {
        $validatedData = $this->validate();

        try {
            $category = ItemCategory::create($validatedData);

            $this->dispatch('store-event', [
                'status' => 'success',
                'message' => 'Record Added Succesfully',
            ]);

            $this->dispatch('close-modal');


            $this->reset('name', 'description');
        } catch (Throwable $th) {
            $this->dispatch('store-event', [
                'status' => 'error',
                'message' => 'Error:' . $th->getMessage(),
                'data' => $category
            ]);

            $this->dispatch('close-modal');
        }
    }

    

    public function render()
    {
        return view('livewire.item-categories.store-categories');
    }
}
