<?php

namespace App\Livewire\UsersList;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Throwable;

class StoreUsers extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:180'],
            'last_name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8'],
            'role' => [
                'required',
                Rule::in($this->getAllowedRoles())
            ],
        ];
    }

    protected function getAllowedRoles()
    {
        $userRole = Auth::user()->role;

        if ($userRole === 'admin') {
            return ['manager', 'employee'];
        } elseif ($userRole === 'manager') {
            return ['employee'];
        }

        return [];
    }

    public function updated($propertyName)
    {
        return $this->validateOnly($propertyName);
    }

    public function storeUser()
    {
        $validatedData = $this->validate();

        try {
            User::create($validatedData);
            $this->dispatch('store-event', [
                'status' => 'success',
                'message' => 'User Added Successfuly',
            ]);
            $this->reset();
        } catch (Throwable $th) {
            $this->dispatch('store-event', [
                'status' => 'error',
                'message' => 'Error: ' . $th->getMessage(),
            ]);
        }
    }

    public function render()
    {
        if (Auth::check() && FacadesAuth::user()->role === 'admin') {
            $roles = ['manager', 'employee'];
        } elseif (Auth::check() && FacadesAuth::user()->role === 'manager') {
            $roles = ['employee'];
        }
        return view('livewire.users-list.store-users', ['roles' => $roles]);
    }
}
