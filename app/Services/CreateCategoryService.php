<?php

namespace App\Services;

use App\Models\Category;

class CreateCategoryService
{


    public function createCategory(array $category_data)
    {

        Category::create($category_data);
    }
}
