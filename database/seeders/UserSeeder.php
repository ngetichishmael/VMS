<?php

namespace Database\Seeders;

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
            'email' => "info@deveint.com",
            'phone_number' => "0724840014",
            "role_id" => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$y5KwRinBAUzQsBuK6EvRXuu0i2RrjTHGs00SOD44S1L9VCMgvx3I6',
        ]);
        User::create([
            'name' => "John Mbugua",
            'email' => "john@deveint.com",
            'phone_number' => "0799005059",
            'email_verified_at' => now(),
            "role_id" => 2,
            'password' => '$2y$10$y5KwRinBAUzQsBuK6EvRXuu0i2RrjTHGs00SOD44S1L9VCMgvx3I6',
        ]);
    }
}
