<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Dossier;

class StateInfosMail extends Mailable {
    use Queueable, SerializesModels;

    public $dossier;
    public $state;
    public $stateString;
    protected $attach;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Dossier $dossier, $state, $stateString) {
        $this->dossier = $dossier;
        $this->state = $state;
        $this->stateString = $stateString;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        if($this->state != 20) {
            return $this->from('evisacameroun@evisacameroun.com', 'E-visa Cameroun')->subject('Votre dossier a été ' . $this->stateString)->markdown('emails.dossiers.state');
        } else {
            $attach = (!\App::environment('local') ? 'public/' : '') . 'storage/back/attestations/attestation.pdf';
            return $this->from('evisacameroun@evisacameroun.com', 'E-visa Cameroun')->subject('Votre dossier a été ' . $this->stateString)->attachData($attach, 'attestation.pdf', ['mime' => 'application/pdf'])->markdown('emails.dossiers.state');
        }
    }
}
