<?php

namespace Database\Seeders;

use App\Models\VisitorType;
use Illuminate\Database\Seeder;

class VisitorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = array(
            ['id' => 1, 'name' => 'Visitor'],
            ['id' => 2, 'name' => 'Staff'],
            ['id' => 3, 'name' => 'Contractor'],
            ['id' => 4, 'name' => 'Vendor'],
            ['id' => 5, 'name' => 'Business'],
            ['id' => 6, 'name' => 'Intern'],
        );

        foreach ($type as $value) {
            VisitorType::create($value);
        }
    }
}
