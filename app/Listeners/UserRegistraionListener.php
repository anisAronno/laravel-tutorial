<?php

namespace App\Listeners;

use App\Events\UserRegistrationEvent;
use App\Notifications\UserRegistrationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;
use Illuminate\Support\Facades\Notification;

class UserRegistraionListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistrationEvent $event): void
    {
        Notification::send($event->user, new UserRegistrationNotification($event->user));
    }

}
