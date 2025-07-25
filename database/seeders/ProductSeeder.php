<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                ProductType::insert([
            ['name' => 'Standard', 'api_unique_number' => 'STD-001'],
            ['name' => 'Premium', 'api_unique_number' => 'PRM-001'],
            ['name' => 'Limited Edition', 'api_unique_number' => 'LTD-001'],
        ]);
    }
}
