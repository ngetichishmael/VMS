<?php

namespace Database\Seeders;

use App\Models\Resident;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Resident::create([
            'unit_id' => 1,
            'name' => 'John Doe',
            'phone_number' => '1234567890',
            'email' => 'johndoe@example.com',
            'user_detail_id' => 1,
        ]);

        Resident::create([
            'unit_id' => 2,
            'name' => 'Jane Doe',
            'phone_number' => '0987654321',
            'email' => 'janedoe@example.com',
            'user_detail_id' => 2,
        ]);



        Resident::create([
            'unit_id' => 3,
            'name' => 'John Mwangi',
                'phone_number' => $faker->phoneNumber,
                'email' => 'johndoe@example.com',
            'user_detail_id' => 3,
        ]);
            Resident::create([
                'unit_id' => 4,
                'name' => 'Jane Waweru',
                'phone_number' => $faker->phoneNumber,
                'email' => 'janesmith@example.com',
                'user_detail_id' => 4,
            ]);
                Resident::create([
                    'unit_id' => 5,
                    'name' => 'Bob Ngetich',
                'phone_number' => $faker->phoneNumber,
                'email' => 'bobjohnson@example.com',
                    'user_detail_id' => 5,
                ]);
                    Resident::create([
                        'unit_id' => 6,
                        'name' => 'Brian Too',
                'phone_number' => $faker->phoneNumber,
                'email' => 'briantoo@example.com',
                        'user_detail_id' => 5,
                    ]);
                        Resident::create([
                            'unit_id' => 6,
                            'name' => 'Jane Alando',
                'phone_number' => $faker->phoneNumber,
                'email' => 'jane@example.com',
                            'user_detail_id' => 5,
                        ]);
    }
}
