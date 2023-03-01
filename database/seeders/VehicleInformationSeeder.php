<?php

namespace Database\Seeders;

use App\Models\VehicleInformation;
use Illuminate\Database\Seeder;

class VehicleInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'registration' => 'ABC123',
                'visitor_id' => '1'
            ],
            [
                'registration' => 'KDE 456F',
                'visitor_id' => '2'
            ],
            [
                'registration' => 'KGH 789L',
                'visitor_id' => '3'
            ],
            [
                'registration' => 'KAL 123P',
                'visitor_id' => '4'
            ],
            [
                'registration' => 'KCN 456J',
                'visitor_id' => '5'
            ]
        ];
        foreach ($data as $value) {
            VehicleInformation::create($value);
        }
    }
}
