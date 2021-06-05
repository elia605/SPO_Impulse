<?php

namespace App\Http\Livewire;

use App\Models\Action;
use App\Models\File;
use App\Models\MemberAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Image;

class GuestActions extends Component
{
    use WithFileUploads;

    public $actions;
    public $title;
    public $description;
    public $members_max;
    public $file;
    public $action_starts_at;
    public $action_ends_at;

    public function mount()
    {
        $this->actions = Action::where('status', 'accepted')->orderBy('created_at', 'desc')->get();
    }

    public function createAction()
    {
        $action = Action::create([
            'user_id' => Auth::user()->id,
            'title' => $this->title,
            'description' => $this->description,
            'members_max' => $this->members_max,
            'action_starts_at' => $this->action_starts_at,
            'action_ends_at' => $this->action_ends_at
        ]);
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

    public function participate($key)
    {
        $memberAction = new MemberAction([
            'user_id' => Auth::user()->id,
            'action_id' => $key,
        ]);
        $memberAction->save();
    }

    public function render()
    {
        $this->actions = Action::where('status', 'accepted')->orderBy('created_at', 'desc')->get();
        return view('livewire.guest-actions');
    }
}
