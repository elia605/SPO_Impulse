<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Image;

class GuestMembers extends Component
{
    use WithFileUploads;

    public $members;
    public $FIO;
    public $birthday;
    public $role;
    public $phone;
    public $email;
    public $group;
    public $file;

    public function createMember()
    {
        $member = Member::create([
            'FIO' => $this->FIO,
            'birthday' => $this->birthday,
            'role' => $this->role,
            'phone' => $this->phone,
            'email' => Auth::user()->email,
            'group' => $this->group,
            'notify' => true,
            'status' => 'unread',
        ]);

        $fileName = time().uniqid(rand()).'.'.$this->file->getClientOriginalExtension();
        $file = new File(['name' => $fileName]);
        $member->file()->save($file);

        $image = $this->file;
        $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(100, 100, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->stream();
        Storage::disk('local')->put('public/img/members' . '/' . $fileName, $img, 'public');
    }

    public function render()
    {
        $this->members = Member::where('status', 'accepted')->orderBy('created_at', 'desc')->get();
        return view('livewire.guest-members');
    }
}
