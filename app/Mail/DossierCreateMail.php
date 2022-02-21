<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;

class DossierCreateMail extends Mailable {
    use Queueable, SerializesModels;

    public $dossier;
    protected $email;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Dossier $dossier) {
        $this->dossier = $dossier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('evisacameroun@evisacameroun.com', 'E-visa Cameroun')->subject('Votre dossier a été bien créé')
                                      ->markdown('emails.dossiers.create');
    }
}
