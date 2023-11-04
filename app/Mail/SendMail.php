<?php

namespace App\Mail;

use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Mail\Mailable; 
use Illuminate\Queue\SerializesModels;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $body;
    public $otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$body,$otp)
    {
        $this->title= $title; 
        $this->body= $body; 
        $this->otp= $otp; 

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
        ->view('customer_mail');
    }
}
