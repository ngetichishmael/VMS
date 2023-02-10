<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationalities = [
            ['id' => 1, 'nationalityName' => 'Afghan'],
            ['id' => 2, 'nationalityName' => 'Albanian'],
            ['id' => 3, 'nationalityName' => 'Algerian'],
            ['id' => 4, 'nationalityName' => 'Kenya'],
            ['id' => 5, 'nationalityName' => 'Uganda'],
            ['id' => 6, 'nationalityName' => 'Tanzania'],
            ['id' => 7, 'nationalityName' => 'Sundan'],
            ['id' => 8, 'nationalityName' => 'Ethiopia'],
            ['id' => 9, 'nationalityName' => 'Nigeria'],
            ['id' => 10, 'nationalityName' => 'Congo'],
            ['id' => 11, 'nationalityName' => 'India'],
            ['id' => 12, 'nationalityName' => 'Japan'],
            ['id' => 13, 'nationalityName' => 'Korea'],
            ['id' => 14, 'nationalityName' => 'Egypt'],
            ['id' => 15, 'nationalityName' => 'China'],
            ['id' => 16, 'nationalityName' => 'Fiji'],
            ['id' => 17, 'nationalityName' => 'Argentina'],
            ['id' => 18, 'nationalityName' => 'France'],

        ];

        DB::table('nationality')->insert($nationalities);
    }
}
