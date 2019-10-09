<?php

namespace App\Listeners;

use App\User;
use App\Events\FormSubmitEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FormSubmittedNotification;

class FormSubmiEventListener
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
     * @param  FormSubmitEvent  $event
     * @return void
     */
    public function handle(FormSubmitEvent $event)
    {

        $notification = new FormSubmittedNotification($event);
        $user = new User();
        Notification::send($user->getAdmin(), $notification);
    }
}
