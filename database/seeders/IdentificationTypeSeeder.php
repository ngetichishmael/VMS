<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identification_types')->insert([
            ['name' => 'Passport'],
            ['name' => 'Driver\'s License'],
            ['name' => 'National ID'],
            ['name' => 'Social Security Number'],
            ['name' => 'Birth Certificate']
        ]);
    }
}
