<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('premises')->insert([
            [

                'premisesName' => 'ABC Plaza',
                'address' => '123 Main Street',
                'location' => 'New York',
                'description' => 'A modern office building located in the heart of the city.',
                'zone' => 'Commercial',
                'type' => 'Office Building',
                'organizationId' => 1,
                'lookUpId' => 1,
            ],
            [
                'premisesName' => 'XYZ Shopping Center',
                'address' => '456 Broadway',
                'location' => 'Los Angeles',
                'description' => 'A popular shopping destination for locals and tourists alike.',
                'zone' => 'Commercial',
                'type' => 'Shopping Mall',
                'organizationId' => 2,
                'lookUpId' => 2,
            ],
            [
                'premisesName' => 'PQR Hotel',
                'address' => '789 Ocean Drive',
                'location' => 'Miami',
                'description' => 'A luxurious hotel with breathtaking ocean views.',
                'zone' => 'Residential',
                'type' => 'Hotel',
                'organizationId' => 3,
                'lookUpId' => 3,
            ],
            [
                'premisesName' => 'GHI School',
                'address' => '101 Elm Street',
                'location' => 'Chicago',
                'description' => 'A well-respected school known for its strong academic programs.',
                'zone' => 'Education',
                'type' => 'School',
                'organizationId' => 4,
                'lookUpId' => 4,
            ],
            [
                'premisesName' => 'JKL Museum',
                'address' => '202 Park Avenue',
                'location' => 'New York',
                'description' => 'A world-renowned museum showcasing some of the most valuable art collections.',
                'zone' => 'Cultural',
                'type' => 'Museum',
                'organizationId' => 5,
                'lookUpId' => 5,
            ],
        ]);
    }
}
