<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['tagName' => 'Technology'],
            ['tagName' => 'Science'],
            ['tagName' => 'Health'],
            ['tagName' => 'Business'],
            ['tagName' => 'Entertainment'],
        ];

        DB::table('tags')->insert($tags);
    }
}
