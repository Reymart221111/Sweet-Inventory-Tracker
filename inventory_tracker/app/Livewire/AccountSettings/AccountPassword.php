<?php

namespace App\Livewire\AccountSettings;

use Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Throwable;

class AccountPassword extends Component
{
    public $old_password;
    public $new_password;
    public $confirm_password;

    protected function rules()
    {
        return [
            'old_password' => ['required', 'string', 'current_password'],
            'new_password' => ['required', 'min:8', 'string'],
            'confirm_password' => ['required', 'same:new_password', 'string'],
        ];
    }

    public function updated($propertyName)
    {
        // If updating password field, only validate password requirements
        if ($propertyName === 'new_password') {
            $this->validateOnly('new_password', [
                'new_password' => ['required', 'min:8', 'string']
            ]);
        }

        // If updating confirmation field, validate the match
        if ($propertyName === 'confirm_password' && !empty($this->confirm_password)) {
            $this->validateOnly('confirm_password', [
                'confirm_password' => ['required', 'same:new_password']
            ]);
        }
    }

    public function updatePassword()
    {
        $this->validate();
        
        try{
            $user = Auth::user();

            $user->update([
                'password' => Hash::make($this->new_password),
            ]);

            $this->reset(['old_password', 'new_password', 'confirm_password']);

            session()->flash('success', 'Password updated successfully!');
        }catch(Throwable $th)
        {
            session()->flash('error', 'Error: '.$th->getMessage());
        }
    }
    public function resetForm()
    {
        $this->reset(['old_password', 'new_password', 'confirm_password']);
    }

    public function clearSession()
    {
        session()->forget([
            'success',
            'error',
        ]);
    }

    public function render()
    {
        return view('livewire.account-settings.account-password');
    }
}
