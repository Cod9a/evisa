<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistrationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    protected $email;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = 'E-visa Cameroun';
        $email = 'evisacameroun@evisacameroun.com';
        return $this->from($email, $name)->subject('Confirmez votre inscription')
                                      ->markdown('emails.users.confirmation');
    }
}
