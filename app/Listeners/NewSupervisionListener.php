<?php

namespace App\Listeners;

use App\Subscriber;
use App\Events\NewSupervision;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\SupervisionAutoResponse;

class NewSupervisionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewSupervision  $event
     * @return void
     */
    public function handle(NewSupervision $event)
    {
        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber){
            $subscriber->notify(new SupervisionAutoResponse($event->supervision, $subscriber));
        }
    }
}