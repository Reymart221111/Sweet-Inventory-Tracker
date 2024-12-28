<?php

namespace App\Livewire\AccountSettings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class AccountSettings extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    private $rolePrefix;

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:180',],
            'last_name' => ['required', 'string', 'min:2', 'max:180',],
            'email' => ['required', 'string', 'min:2', 'max:180', 'email', 'unique:users,email,' . Auth::user()->id,],
        ];
    }

    public function mount()
    {
        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->email = Auth::user()->email;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    private function checkRolePrefix()
    {
        $this->rolePrefix = '';
        if (Auth::user()->role === 'admin') {
            $this->rolePrefix = 'admin';
        } elseif (Auth::user()->role === 'manager') {
            $this->rolePrefix = 'manager';
        } elseif (Auth::user()->role === 'employee') {
            $this->rolePrefix = 'employee';
        }

        return $this->rolePrefix;
    }

    public function updateAccount()
    {
        $validatedData = $this->validate();
        $user = Auth::user();

        try {
            $user->update($validatedData);
            session()->flash('success', 'Updated Succesfully');

            $this->checkRolePrefix();
            return redirect()->route($this->rolePrefix . '.accounts.settings');
        } catch (Throwable $th) {
            session()->flash('error', 'Error:'.$th->getMessage());
        }
    }

    public function clearSession()
    {
        session()->forget([
            'success',
            'error'
        ]);
    }

    public function render()
    {
        return view('livewire.account-settings.account-settings');
    }
}
