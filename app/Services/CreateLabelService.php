<?php

namespace App\Services;

use App\Models\Label;
use App\Models\Ticket;

class CreateLabelService
{


    public function createLabel(array $label_data, Ticket $ticket)
    {


        $label_ids  = [];
        foreach ($label_data as $single_label) {

            $label =  Label::create(['name' => $single_label]);
            $label_ids[] = $label->id;
        }

       
        $ticket->labels()->attach($label_ids);
    }

   /* public function getLabels(){


        $lables = 
    }*/
}
