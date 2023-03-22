<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
               'visitor_type' => true,
            'tag' => true,
            'destination' => true,
            'purpose_of_visit' => true,
            'host' =>false,
            'attachments'=>true,
            'gender'=>true,
            'company'=>true,
            'fingerprint'=>false,
        ]);

        Field::create([
               'visitor_type' => false,
            'tag' => true,
            'destination' => false,
            'purpose_of_visit' => true,
            'host' => false,
            'attachments'=>true,
            'gender'=>true,
            'company'=>true,
            'fingerprint'=>true,
        ]);

        Field::create([
               'visitor_type' => true,
            'tag' => false,
            'destination' => true,
            'purpose_of_visit' => false,
            'host' =>true,
            'attachments'=>false,
            'gender'=>true,
            'company'=>true,
            'fingerprint'=>true
        ]);

        Field::create([
               'visitor_type' => false,
            'tag' => false,
            'destination' => false,
            'purpose_of_visit' => false,
            'host' => false,
            'attachments'=>true,
            'gender'=>true,
            'company'=>true,
            'fingerprint'=>true
        ]);

        Field::create([
               'visitor_type' => true,
            'tag' => true,
            'destination' => false,
            'host' => false,
            'purpose_of_visit' => true,
            'attachments'=>true,
            'gender'=>true,
            'company'=>true,
            'fingerprint'=>true,
        ]);
    }
}
