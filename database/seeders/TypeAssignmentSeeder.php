<?php

namespace Database\Seeders;

use App\Models\TypeAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
              TypeAssignment::insert([
            ['type_assignments_type' => 'product', 'type_assignments_id' => 1, 'my_bonus_field' => 'bonus-1', 'type_id' => 1],
            ['type_assignments_type' => 'product', 'type_assignments_id' => 2, 'my_bonus_field' => 'bonus-2', 'type_id' => 2],
            ['type_assignments_type' => 'product', 'type_assignments_id' => 3, 'my_bonus_field' => 'bonus-3', 'type_id' => 3],
        ]);
    }
}
