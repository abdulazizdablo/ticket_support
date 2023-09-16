<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Ticket;
use App\Models\User;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {

        $created_by = User::find($ticket->user_id);

        $ticket->logs()->create([

            'created_by' => $created_by->name,
            'updated_at' => null
        ]);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        $ticket->logs->create([
            'updated_by' => auth()->user()->name
        ]);
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
