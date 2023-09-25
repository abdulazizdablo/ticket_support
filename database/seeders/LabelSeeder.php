<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels_data = ['bug', 'question', 'enhacment'];

        foreach ($labels_data as $single_label) {
            Label::create(['name' => $single_label]);
        }
    }
}
