<?php

namespace App\Services;

use App\Models\Label;

class CreateLabelService
{


    public function createLabel(array $label_data)
    {

        Label::create($label_data);
    }
}
