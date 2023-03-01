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

                'name' => 'ABC Plaza',
                'address' => '123 Main Street',
                'location' => 'New York',
                'description' => 'A modern office building located in the heart of the city.',
//                'zone' => 'Commercial',
//                'type' => 'Office Building',
                'organization_code' => "wM1z4nZsIYughLausC6D",
//                'lookUpId' => 1,
            ],
            [
                'name' => 'Shopping Center',
                'address' => '456 Broadway',
                'location' => 'Los Angeles',
                'description' => 'A popular shopping destination for locals and tourists alike.',
//                'zone' => 'Commercial',
//                'type' => 'Shopping Mall',
                'organization_code' => "wM1z4nZsIYughLausC6D",
//                'lookUpId' => 2,
            ],
            [
                'name' => 'PQR Hotel',
                'address' => '789 Ocean Drive',
                'location' => 'Miami',
                'description' => 'A luxurious hotel with breathtaking ocean views.',
//                'zone' => 'Residential',
//                'type' => 'Hotel',
                'organization_code' => "wM1z4nZsIYughLausC6E",
//                'lookUpId' => 3,
            ],
            [

                'name' => 'ABC Plaza',
                'address' => '123 Main Street',
                'location' => 'New York',
                'description' => 'A modern office building located in the heart of the city.',
//                'zone' => 'Commercial',
//                'type' => 'Office Building',
                'organization_code' => "wM1z4nZsIYughLausC6E",
//                'lookUpId' => 1,
            ],
            [
                'name' => 'XYZ Shopping Center',
                'address' => '456 Broadway',
                'location' => 'Los Angeles',
                'description' => 'A popular shopping destination for locals and tourists alike.',
//                'zone' => 'Commercial',
//                'type' => 'Shopping Mall',
                'organization_code' => "PxtHUoetmH2vDA46xmR0",
//                'lookUpId' => 2,
            ],
            [
                'name' => 'Oracle',
                'address' => '789 Ocean Drive',
                'location' => 'Westlands',
                'description' => 'A luxurious hotel with breathtaking ocean views.',
//                'zone' => 'Residential',
//                'type' => 'Hotel',
                'organization_code' => "wM1z4nZsIYughLausC6F",
//                'lookUpId' => 3,
            ],
            [
                'name' => 'GHI School',
                'address' => '101 Elm Street',
                'location' => 'Chicago',
                'description' => 'A well-respected school known for its strong academic programs.',
//                'zone' => 'Education',
//                'type' => 'School',
                'organization_code' => "wM1z4nZsIYughLausC6F",
//                'lookUpId' => 4,
            ],
            [
                'name' => 'Nairobi Museum',
                'address' => 'Park Avenue',
                'location' => 'Nairobi',
                'description' => 'A world-renowned museum showcasing some of the most valuable art collections.',
//                'zone' => 'Cultural',
//                'type' => 'Museum',
                'organization_code' => "wM1z4nZsIYughLausC6G",
//                'lookUpId' => 5,
            ],
            [
                'name' => 'Uhuru Park',
                'address' => 'Uhuru Avenue',
                'location' => 'Nairobi',
                'description' => 'A world-renowned museum showcasing some of the most valuable art collections.',
//                'zone' => 'Cultural',
//                'type' => 'Museum',
                'organization_code' => "wM1z4nZsIYughLausC6H",
//                'lookUpId' => 5,
            ],
        ]);
    }
}
