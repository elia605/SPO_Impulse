<?php

namespace App\Mail;

use App\Models\Action;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActionNotification extends Mailable
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
        return $this->view('emails.actionNotification', ['action' => $this->action, 'user' => $this->user]);
    }
}
