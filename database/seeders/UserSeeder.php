<?php

namespace Database\Seeders;

use App\Models\Sentry;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Ish",
            'email' => "ishmael@deveint.com",
            'phone_number' => "0724840014",
            "role_id" => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$y5KwRinBAUzQsBuK6EvRXuu0i2RrjTHGs00SOD44S1L9VCMgvx3I6',
            'organization_code' => 'wM1z4nZsIYughLausC6F'

        ]);
        User::create([
            'name' => "John Mbugua",
            'email' => "john@deveint.com",
            'phone_number' => "0799005059",
            'email_verified_at' => now(),
            "role_id" => 2,
            'password' => '$2y$10$y5KwRinBAUzQsBuK6EvRXuu0i2RrjTHGs00SOD44S1L9VCMgvx3I6',
            'organization_code' => 'wM1z4nZsIYughLausC6E'
        ]);
        User::create([
            'name' => "Stephen Maina",
            'email' => "info@deveint.com",
            'phone_number' => "0710767015",
            'email_verified_at' => now(),
            "role_id" => 4,
            'password' => '$2y$10$y5KwRinBAUzQsBuK6EvRXuu0i2RrjTHGs00SOD44S1L9VCMgvx3I6',
            'organization_code' => 'wM1z4nZsIYughLausC6D'
        ]);
        Sentry::create([
            'name' => 'Ishmael ',
            'status' => 1,
            'phone_number' => "+254 724 840014",
            'device_id' => 1,
            'user_detail_id' => 1,
            'shift_id' => 1,
            'premise_id' => 1,

        ]);
        Sentry::create([
            'name' => 'John Mbugua',
            'status' => 1,
            'device_id' => 2,
            'phone_number' => "0799005059",
            'user_detail_id' => 2,
            'shift_id' => 1,
            'premise_id' => 2,

        ]);
        Sentry::create([
            'name' => 'Stephen Maina',
            'status' => 1,
            'device_id' => 3,
            'phone_number' => "0710767015",
            'user_detail_id' => 3,
            'shift_id' => 2,
            'premise_id' => 3,

        ]);
    }
}
