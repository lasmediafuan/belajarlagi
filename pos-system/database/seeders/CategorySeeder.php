<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Food', 'description' => 'Food items']);
        \App\Models\Category::create(['name' => 'Beverage', 'description' => 'Drinks']);
        \App\Models\Category::create(['name' => 'Snacks', 'description' => 'Snack items']);
    }
}
