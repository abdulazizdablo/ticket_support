<?php

namespace App\Services;

use App\Models\Label;
use App\Models\Ticket;

class CreateLabelService
{


    public function createLabel(array $label_data, Ticket $ticket)
    {


        $label_array  = [];
        foreach ($label_data as $single_label) {

            $label_array[] =  Label::create(['name' => $single_label]);
        }
        dd($label_array);
        $ticket->labels()->attach($label_array);
    }
}
