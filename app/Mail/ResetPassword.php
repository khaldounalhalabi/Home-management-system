<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name ; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Home-EMS@Email.com', 'Home Management System')
            ->greeting('Hello'.$name)
            ->line('
                You Want to reset your password
                Click on the URL bellow')
            ->action('RESET YOUR PASSWORD', 'http://127.0.0.2/api/reset')
            ->line('Thank you for using our system !');
    }
}
