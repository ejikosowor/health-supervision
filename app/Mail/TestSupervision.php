<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestSupervision extends Mailable
{
    use Queueable, SerializesModels;

    private $supervision;
    private $subscriber;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($supervision, $subscriber)
    {
        $this->supervision = $supervision;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->view('emails.new-supervision', ['supervision' => $this->supervision, 'subscriber' => $this->subscriber]);
    }
}
