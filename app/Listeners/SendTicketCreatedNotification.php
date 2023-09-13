<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Enums\Roles;
use App\Notifications\TicketCreated;

class SendTicketCreatedNotification
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
    public function handle(object $event): void
    {

        $admin = User::where('role_id', Roles::ADMINSTRATOR)->first();


        $admin->notify(new TicketCreated($event->ticket, $admin));
    }
}
