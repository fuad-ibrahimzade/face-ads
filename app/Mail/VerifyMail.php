<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_create)
    {
        //
        $this->user = $user_create;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->view('view.name');
        return $this->view('emails.verifyUser',['user'=> $this->user]);

//        $address = 'xasohawer@onemail1.com';
//        $subject = 'This is a demo!';
//        $name = 'Xason Hawer';

//        return $this->view('emails.verifyUser')
//            ->from($address, $name)
//            ->cc($address, $name)
//            ->bcc($address, $name)
//            ->replyTo($address, $name)
//            ->subject($subject)
//            ->with([ 'user' => $this->user ]);

    }
}
