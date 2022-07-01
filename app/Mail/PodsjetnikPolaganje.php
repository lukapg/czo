<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class PodsjetnikPolaganje extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $input = array(
            'ime'     => $this->mailData['ime'],
            'prezime'     => $this->mailData['prezime'],
            'datum_polaganja'     => $this->mailData['datum_polaganja']
        );
        return $this->from('cedis@cedis.me')->subject('Centar za obuku - Podsjetnik o organizovanju obuke')->view('email.podsjetnik')->with(['data' => $input]);
    }
}
