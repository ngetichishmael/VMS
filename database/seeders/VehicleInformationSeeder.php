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
                'type' => 'Car',
                'color' => 'Red',
                'model' => 'Honda Civic',
                'visitor_id' => '1'
            ],
            [
                'registration' => 'KDE 456F',
                'type' => 'Truck',
                'color' => 'Blue',
                'model' => 'Ford F-150',
                'visitor_id' => '2'
            ],
            [
                'registration' => 'KGH 789L',
                'type' => 'SUV',
                'color' => 'Black',
                'model' => 'Chevrolet Tahoe',
                'visitor_id' => '3'
            ],
            [
                'registration' => 'KAL 123P',
                'type' => 'Van',
                'color' => 'White',
                'model' => 'Dodge Grand Caravan',
                'visitor_id' => '4'
            ],
            [
                'registration' => 'KCN 456J',
                'type' => 'Car',
                'color' => 'Silver',
                'model' => 'Toyota Camry',
                'visitor_id' => '5'
            ]
        ]);
    }
}
