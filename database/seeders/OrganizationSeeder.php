<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

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
            'name' => 'Velocies',
            'location' => 'Location 1',
            'email' => 'organization1@email.com',
            'phoneNumber1' => '0111111111',
            'phoneNumber2' => '0111111112',
            'landLine' => '1111111',
            'description' => 'Description for organization 1',
            'websiteUrl' => 'https://www.organization1.com',
        ]);

        Organization::create([
            'name' => 'Deveint',
            'location' => 'Location 2',
            'email' => 'organization2@email.com',
            'phoneNumber1' => '0222222222',
            'phoneNumber2' => '0222222223',
            'landLine' => '2222222',
            'description' => 'Description for organization 2',
            'websiteUrl' => 'https://www.organization2.com',
        ]);

        Organization::create([
            'name' => 'prime bank',
            'location' => 'Location 3',
            'email' => 'organization3@email.com',
            'phoneNumber1' => '0333333333',
            'phoneNumber2' => '0333333334',
            'landLine' => '3333333',
            'description' => 'Description for organization 3',
            'websiteUrl' => 'https://www.organization3.com',
        ]);

        Organization::create([
            'name' => 'Equity',
            'location' => 'Location 4',
            'email' => 'organization4@email.com',
            'phoneNumber1' => '0444444444',
            'phoneNumber2' => '0444444445',
            'landLine' => '4444444',
            'description' => 'Description for organization 4',
            'websiteUrl' => 'https://www.organization4.com',
        ]);

        Organization::create([
            'name' => 'JAMBOPAY',
            'location' => 'Location 5',
            'email' => 'organization5@email.com',
            'phoneNumber1' => '0555555555',
            'phoneNumber2' => '0555555556',
            'landLine' => '5555555',
            'description' => 'Description for organization 5',
            'websiteUrl' => 'https://www.organization5.com',
        ]);
    }
}
