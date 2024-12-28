<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class LogoutModal extends Component
{
    public $showLogoutModal = false;

   
    #[On('open-modal')]
    public function openModal()
    {
        $this->showLogoutModal = true;
    }

    public function closeModal()
    {
        $this->showLogoutModal = false;
    }


    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Access the current session using the request() helper
        $session = request()->session();

        // Ensure all session data is removed
        $session->flush();

        // Invalidate the session and regenerate the CSRF token
        $session->invalidate();
        $session->regenerateToken();

        // Redirect to the login route
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.logout-modal');
    }
}
