<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories_data = ['Uncategorized', 'Billing/Payment', 'Technical question'];

        foreach ($categories_data as $single_category) {
            Category::create(['name' => $single_category]);
        }
    }
}
