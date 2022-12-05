<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendZonesFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from($address = 'info@cloudtica.com', $name = 'Fossil Free Zones')
        ->subject('Thank Your For Submitting The Form')
        ->view('mails.zonesFormMail')
        ->with([
            'form' => $this->form
        ]);
    }
}
