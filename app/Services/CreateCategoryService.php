<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Ticket;

class CreateCategoryService
{


    public function createCategory(array $category_data, Ticket $ticket)
    {

        $category_ids = [];
        foreach ($category_data as $single_category) {

            $category = Category::create(['name' => $single_category]);
            $category_ids[]  = $category->id;
        }

        $ticket->categories()->attach($category_ids);
    }
}
