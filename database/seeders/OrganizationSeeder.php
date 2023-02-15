<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            'code' => Str::random(20),
            'name' => 'Velocies',
            'location' => 'Location 1',
            'email' => 'organization1@email.com',
            'primary_phone' => '0111111111',
            'secondary_phone' => '0111111112',
//            'landLine' => '1111111',
            'description' => 'Description for organization 1',
            'websiteUrl' => 'https://www.organization1.com',
        ]);

        Organization::create([
            'code' => Str::random(20),
            'name' => 'Deveint',
            'location' => 'Location 2',
            'email' => 'organization2@email.com',
            'primary_phone' => '0222222222',
            'secondary_phone' => '0222222223',
//            'landLine' => '2222222',
            'description' => 'Description for organization 2',
            'websiteUrl' => 'https://www.organization2.com',
        ]);

        Organization::create([
            'code' => Str::random(20),
            'name' => 'prime bank',
            'location' => 'Location 3',
            'email' => 'organization3@email.com',
            'primary_phone' => '0333333333',
            'secondary_phone' => '0333333334',
//            'landLine' => '3333333',
            'description' => 'Description for organization 3',
            'websiteUrl' => 'https://www.organization3.com',
        ]);

        Organization::create([
            'code' => Str::random(20),
            'name' => 'Equity',
            'location' => 'Location 4',
            'email' => 'organization4@email.com',
            'primary_phone' => '0444444444',
            'secondary_phone' => '0444444445',
//            'landLine' => '4444444',
            'description' => 'Description for organization 4',
            'websiteUrl' => 'https://www.organization4.com',
        ]);

        Organization::create([
            'code' => Str::random(20),
            'name' => 'JAMBOPAY',
            'location' => 'Location 5',
            'email' => 'organization5@email.com',
            'primary_phone' => '0555555555',
            'secondary_phone' => '0555555556',
//            'landLine' => '5555555',
            'description' => 'Description for organization 5',
            'websiteUrl' => 'https://www.organization5.com',
        ]);
    }
}
