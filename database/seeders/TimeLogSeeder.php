<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_logs')->insert([
            'entry_time' => Carbon::now(),
            'exit_time' => Carbon::now()->addHours(8),
        ]);

        DB::table('time_logs')->insert([
            'entry_time' => Carbon::now()->subDays(1)->addHours(10),
            'exit_time' => Carbon::now()->subDays(1)->addHours(18),
        ]);
    }
}
