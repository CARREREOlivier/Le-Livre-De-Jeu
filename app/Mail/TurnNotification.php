<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TurnNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
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
        return $this->from('le.livre.de.jeu@gmail.com')
            ->subject($this->email->subject)
            ->view('gamesessions.mails.notification')
            ->text('gamesessions.mails.notification_plain')
            ->with(
                [
                    'message' => $this->email->message,
                    'link' => $this->email->link,
                    'turn_title' =>  $this->email->turn_title,
                ]);
    }
}
