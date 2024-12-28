<?php

namespace App\Livewire\UsersList;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateUsers extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;
    public $userId;


    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:180'],
            'last_name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => ['nullable', 'min:8'],
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

    #[On('updateUser')]
    public function PrepareUserData($recordId)
    {
        $this->userId = $recordId;

        $user = User::find($this->userId);

        if ($user) {
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->role = $user->role;
        }
    }

    public function updateUser()
    {
        $validatedData = $this->validate();

        $user = User::findOrFail($this->userId);

        if (!$this->password) {
            unset($validatedData['password']);
        }

        try {
            $user->update($validatedData);

            if ($this->password) {
                $this->reset('password');
            }

            $this->dispatch('update-event', [
                'status' => 'success',
                'message' => 'User Added Successfuly',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('update-event', [
                'status' => 'error',
                'message' => 'Error: ' . $th->error,
            ]);
        }
    }

    public function render()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $roles = ['manager', 'employee'];
        } elseif (Auth::check() && Auth::user()->role === 'manager') {
            $roles = ['employee'];
        }
        return view('livewire.users-list.update-users', ['roles' => $roles]);
    }
}
