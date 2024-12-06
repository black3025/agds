<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
Use App\Models\User;
use App\Notifications\NewEnrollmentNotification;
use Illuminate\Notifications\Notifiable;
class SendNewEnrollmentNotification
{
    use Notifiable;
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
    public function handle(object $event): void
    {
        $admins = User::whereHas('role', function($q){
            $q->where('id',1);
        })->get();
        \Notification::send($admins, new NewEnrollmentNotification($event->user));
    }
}
