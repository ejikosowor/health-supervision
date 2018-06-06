<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SupervisionAutoResponse extends Notification implements ShouldQueue
{
    use Queueable;
    
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->view('emails.new-supervision', ['supervision' => $this->supervision, 'subscriber' => $this->subscriber])
                    ->subject('Supervision Score Summary ' .$this->supervision->category->name);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'supervision' => $this->supervision,
            'subscriber' => $this->subscriber,
        ];
    }
}