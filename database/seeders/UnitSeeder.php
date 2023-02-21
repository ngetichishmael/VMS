<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitNames = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4', 'Unit 5', 'Unit 6', 'Unit 7' ];
        $id=0;

        foreach ($unitNames as $name) {
            Unit::create([
                'block_id' => 1,
                'name' => $name,
            ]);
        }
        $unitNames = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4', 'Unit 5', 'Unit 6', 'Unit 7' ];
        foreach ($unitNames as $name) {
            Unit::create([
                'block_id' => 2,
                'name' => $name,
            ]);
        }
        $unitNames = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4' ];
        foreach ($unitNames as $name) {
            Unit::create([
                'block_id' => 3,
                'name' => $name,
            ]);
        }
        $unitNames = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4' ];
        foreach ($unitNames as $name) {
            Unit::create([
                'block_id' => 4,
                'name' => $name,
            ]);
        }
        $unitNames = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4','Unit A', 'Unit B', 'Unit C', 'Unit D' ,'Unit E', 'Unit F', 'Unit G', 'Unit H'];
        $id=4;
            foreach ($unitNames as $name) {
                Unit::create([
                    'block_id' => $id++,
                    'name' => $name,
                ]);
            }

    }
}
