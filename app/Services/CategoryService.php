<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService
{

    public function getCategories()
    {

        return  Cache::remember('categories', now()->addHour(2), function () {
            return Category::all();
        });
    }
}
