<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $email;

    /**
     * Create a new message instance.
     *
     * ContactEmail constructor.
     * @param $demo
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sender@example.com')
            ->cc($this->email->cc)
            ->subject($this->email->subject)
            ->view('contact.contactEmail')
            ->text('contact.contactEmail_plain')
            ->with(
                [
                    'message' => $this->email->message,

            ]);
    }
}
