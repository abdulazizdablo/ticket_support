<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Ticket;

class CreateCategoryService
{


    public function createCategory(array $category_data, Ticket $ticket)
    {

        $category_array = [];
        foreach ($category_data as $single_category) {

            $category_array[] = Category::create(['name' => $single_category]);
        }

        $ticket->categories()->attach($category_array);
    }
}
