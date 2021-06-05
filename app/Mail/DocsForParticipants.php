<?php

namespace App\Mail;

use App\Models\Action;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DocsForParticipants extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $action;
    public $user;

    public function __construct(Action $action, User $user)
    {
        $this->action = $action;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.docsForParticipants', ['action' => $this->action, 'user' => $this->user])
            ->attach(public_path().'/storage/pdf/invoice_'.$this->action->id.'_'.$this->user->email.'.pdf');
    }
}
