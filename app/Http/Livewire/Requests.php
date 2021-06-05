<?php

namespace App\Http\Livewire;

use App\Models\Action;
use App\Models\Member;
use App\Models\User;
use Livewire\Component;

class Requests extends Component
{
    public int $type;
    public $members;
    public $actions;

    public function mount()
    {
        $this->type = 1;
    }

    public function acceptMemberRequest(Member $member)
    {
        $member->status = 'accepted';
        $user = User::where('email', $member->email)->first();
        $role = $user->roles->where('role', 'guest')->first();
        $role->role = 'member';
        $role->save();
        $member->save();
    }

    public function rejectMemberRequest(Member $member)
    {
        $member->status = 'rejected';
        $member->save();
    }

    public function acceptActionRequest(Action $action)
    {
        $action->status = 'accepted';
        $action->save();
    }

    public function rejectActionRequest(Action $action)
    {
        $action->status = 'rejected';
        $action->save();
    }

    public function render()
    {
        $this->members = Member::whereIn('status', ['unread', 'rejected'])->orderBy('status', 'desc')->get();
        $this->actions = Action::whereIn('status', ['unread', 'rejected'])->orderBy('status', 'desc')->get();
        return view('livewire.requests');
    }
}
