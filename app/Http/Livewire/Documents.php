<?php

namespace App\Http\Livewire;

use App\Mail\ActionNotification;
use App\Mail\DocsForParticipants;
use App\Models\Action;
use App\Models\Member;
use App\Models\MemberAction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PDF;

class Documents extends Component
{
    public $actions;
    public $selectedAction;
    public bool $sendByEmail = false;
    public $action;
    public $memberActions;
    public $files;

    public function createDocs()
    {
        $users = User::all()->pluck('id')->toArray();
        $memberAction = MemberAction::whereIn('user_id', $users)->where('action_id', $this->selectedAction)->get();
        return response()->streamDownload(function () use ($memberAction) {
            $pdf = App::make('dompdf.wrapper');
            foreach ($memberAction as $member) {
                $pdf->loadView('pdf.docForParticipants', [
                    'action' => Action::find($this->selectedAction),
                    'user' => $member->user,
                    'date' => Carbon::now()->format('d.m.Y'),
                ])->stream('invoice_' . $this->selectedAction . '_' . $member->user->email . '.pdf');
                Storage::disk('local')->put('public/pdf/' . '/' . 'invoice_' . $this->selectedAction . '_' . $member->user->email . '.pdf', $pdf, 'public');
                if ($this->sendByEmail === true)
                {
                    Mail::to($member->user->email)->send(new DocsForParticipants(Action::find($this->selectedAction), $member->user));
                }
            }
        });
    }

    public function render()
    {
        if ($this->selectedAction !== null)
        {
            $this->memberActions = MemberAction::where('action_id', $this->selectedAction)->get();
        }
        $this->actions = Action::all()->sortByDesc('created_at');
        $this->files = Storage::files('public/pdf');

        return view('livewire.documents');
    }
}
