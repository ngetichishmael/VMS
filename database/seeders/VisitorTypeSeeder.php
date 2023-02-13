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
            ['id' => 1, 'description' => 'Visitor'],
            ['id' => 2, 'description' => 'Staff'],
            ['id' => 3, 'description' => 'Contractor'],
            ['id' => 4, 'description' => 'Vendor'],
            ['id' => 5, 'description' => 'Business'],
            ['id' => 6, 'description' => 'Intern'],
            // ...
        ];

        DB::table('visitortype')->insert($type);
    }
}
