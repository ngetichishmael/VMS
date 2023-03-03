<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            VisitorSeeder::class,
            VisitorTypeSeeder::class,
            VehicleInformationSeeder::class,
            TagSeeder::class,
            UnitSeeder::class,
            BlockSeeder::class,
            OrganizationSeeder::class,
            IdentificationTypeSeeder::class,
            PremiseSeeder::class,
            PurposeSeeder::class,
            ResidentSeeder::class,
            UserDetailSeeder::class,
            TimeLogSeeder::class,
            SettingSeeder::class,
            FieldsSeeder::class,
            ShiftSeeder::class,

        ]);
    }
}
