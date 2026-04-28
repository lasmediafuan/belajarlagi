<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create(['name' => 'Burger', 'description' => 'Delicious burger', 'price' => 10.00, 'stock' => 50, 'category_id' => 1]);
        \App\Models\Product::create(['name' => 'Pizza', 'description' => 'Cheesy pizza', 'price' => 15.00, 'stock' => 30, 'category_id' => 1]);
        \App\Models\Product::create(['name' => 'Coke', 'description' => 'Cold drink', 'price' => 2.00, 'stock' => 100, 'category_id' => 2]);
        \App\Models\Product::create(['name' => 'Chips', 'description' => 'Crunchy chips', 'price' => 3.00, 'stock' => 80, 'category_id' => 3]);
    }
}
