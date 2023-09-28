<?php

namespace App\Services;

use App\Models\Label;
use Illuminate\Support\Facades\Cache;

class LabelService
{
    public function getLabels()
    {
        return  Cache::remember('labels', now()->addHour(2), function () {
            return Label::all('id','name');
        });
    }
}
