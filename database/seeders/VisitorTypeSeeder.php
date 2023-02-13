<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['id' => 1, 'name' => 'Visitor'],
            ['id' => 2, 'name' => 'Staff'],
            ['id' => 3, 'name' => 'Contractor'],
            ['id' => 4, 'name' => 'Vendor'],
            ['id' => 5, 'name' => 'Business'],
            ['id' => 6, 'name' => 'Intern'],
            // ...
        ];

        DB::table('visitor_types')->insert($type);
    }
}
