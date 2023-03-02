<?php

namespace Database\Seeders;

use App\Models\Shift;
use App\Models\Role;
use Carbon\Carbon;

use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create([
            'name' => "Day",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Shift::create([
            'name' => "Night",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => "Admin",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => "staff",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

     
    }
}
