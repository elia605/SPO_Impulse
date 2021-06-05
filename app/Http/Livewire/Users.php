<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;
    public $search;
    public $query;
    public $name;
    public $role;
    public $email;

    public $selectedUser;

    public function mount()
    {
        $this->query = User::all()->sortByDesc('created_at');
    }

    public function editUser(User $user)
    {
        $this->selectedUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->role;
    }

    public function saveEditions(User $user)
    {
        $role = Role::where('user_id', $user->id)->first();
        $this->selectedUser->name = $this->name;
        $this->selectedUser->email = $this->email;
        $role->role = $this->role;
        $role->save();
        $this->selectedUser->save();
    }

    public function updatedSearch()
    {
        $this->query = User::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function render()
    {
        $this->users = $this->query;
        return view('livewire.users', ['users' => $this->users]);
    }
}
