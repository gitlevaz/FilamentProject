<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             Product::insert([
            ['name' => 'Smartphone', 'description' => 'Latest 5G smartphone', 'product_category_id' => 1, 'product_color_id' => 1],
            ['name' => 'Novel Book', 'description' => 'Fiction novel', 'product_category_id' => 2, 'product_color_id' => 2],
            ['name' => 'Office Chair', 'description' => 'Ergonomic chair', 'product_category_id' => 3, 'product_color_id' => 3],
        ]);
    }
}
