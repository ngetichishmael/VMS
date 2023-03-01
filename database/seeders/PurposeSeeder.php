<?php

namespace Database\Seeders;

use App\Models\Purpose;
use Illuminate\Database\Seeder;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purposes = [
            [
                'purpose_description' => 'Business Meeting',
            ],
            [
                'purpose_description' => 'Delivery',
            ],
            [
                'purpose_description' => 'Maintenance',
            ],
            [
                'purpose_description' => 'Personal Visit',
            ],
            [
                'purpose_description' => 'Training',
            ],
        ];

        Purpose::insert($purposes);
    }
}
