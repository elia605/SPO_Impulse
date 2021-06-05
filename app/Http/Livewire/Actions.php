<?php

namespace App\Http\Livewire;

use App\Mail\ActionNotification;
use App\Models\Action;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Image;
use Auth;
use Livewire\WithFileUploads;

class Actions extends Component
{
    use WithFileUploads;
    public $actions;
    public $title;
    public $description;
    public $members_max;
    public $file;
    public $action_starts_at;
    public $action_ends_at;

    public function createAction()
    {
        /*$this->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'members_max' => 'required|numeric|min:1',
            'action_starts_at' => 'required',
            'action_ends_at' => 'required|gt:action_starts_at',
            'file' => 'required',
        ]);*/
        $action = Action::create([
            'user_id' => Auth::user()->id,
            'title' => $this->title,
            'description' => $this->description,
            'members_max' => $this->members_max,
            'status' => 'accepted',
            'action_starts_at' => $this->action_starts_at,
            'action_ends_at' => $this->action_ends_at
        ]);
        $action->status = 'accepted';
        $action->save();
        $fileName = time().uniqid(rand()).'.'.$this->file->getClientOriginalExtension();
        $file = new File(['name' => $fileName]);
        $action->file()->save($file);

        $image = $this->file;
        $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(400, null, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->stream();
        $img2 = $img->brightness(-50);
        $img2->stream();
        Storage::disk('local')->put('public/img/actions' . '/' . $fileName, $img, 'public');
        Storage::disk('local')->put('public/img/actions/darken' . '/' . $fileName, $img2, 'public');

    }

    public function deleteAction (Action $action)
    {
        $action->delete();
    }

    public function sendNotifications (Action $action)
    {
        $users = User::all();
        foreach ($users as $user)
        {
            Mail::to($user->email)->send(new ActionNotification($action, $user));
        }
    }

    public function render()
    {
        $this->actions = Action::all()->sortBy('created_at');

        return view('livewire.actions');
    }
}
