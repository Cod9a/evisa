<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $data;
    protected $email;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = Auth::user()->name . ' ' . Auth::user()->surname;
        $email = Auth::user()->email;
        return $this->from($email, $name)->subject('Paiement effectué avec succès')
                                      ->markdown('emails.dossiers.paid');
    }
}
