<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitNames = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4', 'Unit 5'];
        $id=0;

        foreach ($unitNames as $name) {
            Unit::create([
                'block_id' => $id+1,
                'name' => $name,
            ]);
        }
    }
}
