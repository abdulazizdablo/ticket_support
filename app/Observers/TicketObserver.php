<?php

namespace App\Observers;


use App\Models\Ticket;


class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        $ticket->logs()->insert([
            'ticket_title' => $ticket->title,
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'created_by' => auth()->user()->name,
            'created_at' => now()
        ]);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {


        
        $ticket->logs()->insert([
            'ticket_id' => $ticket->id,
            'ticket_title' => $ticket->title,
            'user_id' => auth()->id(),
            'updated_by' => auth()->user()->name,
            'updated_at' => now()
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
