<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageRecovery extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Array $email)
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
      return $this->from('team@anthropi.fr')
                  ->subject('Relance inscription formation - AnthroPi')
                  ->view('emails.messageRecovery');
    }
}
