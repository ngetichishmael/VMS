<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_information')->insert([
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
        ]);
    }
}
