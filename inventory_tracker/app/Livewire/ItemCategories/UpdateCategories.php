<?php

namespace App\Livewire\ItemCategories;

use App\Models\ItemCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class UpdateCategories extends Component
{

    
    public $name;
    public $description;
    public $categoryId;
    public $category;


    public function rules()
    {
        return [
            'name' => [Rule::unique('item_categories', 'name')->ignore($this->categoryId), 'required', 'string', 'max:180', 'min:4'],
            'description' => ['required', 'string', 'max:500'],
        ];
    }

    #[On('updateCategory')]
    public function handleEditParoleEvent($recordId)
    {
        $this->resetValidation();

        $this->categoryId = $recordId;

        $this->category = ItemCategory::find($recordId);
        $this->name = $this->category->name;
        $this->description = $this->category->description;
    }

    public function resetValidation($field = null)
    {
        debugbar()->info('Validation reset triggered');
        parent::resetValidation($field);
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

    public function updateCategory()
    {
        $validatedData = $this->validate();

        $category = ItemCategory::findOrFail($this->categoryId);

        try {
            $category->update($validatedData);

            $this->dispatch('update-event', [
                'status' => 'success',
                'message' => 'Record Updated Succesfully',
            ]);
        } catch (Throwable $th) {
            $this->dispatch('update-event', [
                'status' => 'error',
                'message' => 'Error:' . $th->getMessage(),
            ]);
        }
    }

    public function updated($propertyName)
    {
        return $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.item-categories.update-categories');
    }
}
