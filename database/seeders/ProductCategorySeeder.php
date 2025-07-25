<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          ProductCategory::insert([
            ['name' => 'Electronics', 'description' => 'Electronic gadgets', 'external_url' => 'https://example.com/electronics'],
            ['name' => 'Books', 'description' => 'Books and Magazines', 'external_url' => null],
            ['name' => 'Furniture', 'description' => 'Home and Office furniture', 'external_url' => 'https://example.com/furniture'],
        ]);
    }
}
