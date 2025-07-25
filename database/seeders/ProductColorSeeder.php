<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
              ProductColor::insert([
            ['name' => 'Red', 'description' => 'Bright red color', 'hex_code' => '#FF0000'],
            ['name' => 'Blue', 'description' => 'Sky blue shade', 'hex_code' => '#0000FF'],
            ['name' => 'Green', 'description' => 'Nature green', 'hex_code' => '#00FF00'],
        ]);
    }
}
