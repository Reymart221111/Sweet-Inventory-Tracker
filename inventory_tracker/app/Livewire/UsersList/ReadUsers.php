<?php

namespace App\Livewire\UsersList;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ReadUsers extends Component
{
    use WithPagination;

    public $search;
    public $selectedRole;

    protected $queryString = [
        'page' => ['except' => ''],
        'search' => ['except' => ''],
        'selectedRole' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('store-event')]
    public function handleStoreEvent($event)
    {
        if ($event['status'] === 'success') {
            session()->flash($event['status'], $event['message']);
        } else {
            session()->flash($event['status'], $event['message']);
        }
    }

    #[On('update-event')]
    public function handleUpdateEvent($event)
    {
        if ($event['status'] === 'success') {
            session()->flash($event['status'], $event['message']);
        } else {
            session()->flash($event['status'], $event['message']);
        }
    }

    public function clearSession()
    {
        session()->forget(['success', 'error']);
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);

        try {
            $user->delete();

            session()->flash('success', 'Record Deleted Succesfully');
        } catch (\Throwable $th) {
            session()->flash('error', 'Error:' . $th->getMessage());
        }
    }

    public function render()
    {
        $roles = ['admin', 'manager', 'employee'];

        $users = User::query()
            ->where(function ($query) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$this->search}%"])
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->when($this->selectedRole, function ($query) {
                $query->where('role', $this->selectedRole);
            })
            ->paginate(10);

        return view('livewire.users-list.read-users', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
