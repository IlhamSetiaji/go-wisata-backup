<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     * 
     */

    public $details;
    public $tiket;
    public $desc;

    public function __construct($details, $tiket, $desc)
    {
        $this->details = $details;
        $this->$tiket = $tiket;
        $this->desc = $desc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from GoWisata')
            ->view('pelanggan.tiket-pdf');
    }
}
