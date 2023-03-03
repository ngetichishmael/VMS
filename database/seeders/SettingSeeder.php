<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'organization_code' => 'wM1z4nZsIYughLausC6D',
            'id_checkin' => true,
            'automatic_id_checkin' => true,
            'sms_checkin' => true,
            'ipass_checkin' => true,
            'field_id' =>1,
        ]);

        Setting::create([
            'organization_code' => 'wM1z4nZsIYughLausC6E',
            'id_checkin' => false,
            'automatic_id_checkin' => true,
            'sms_checkin' => false,
            'ipass_checkin' => true,
            'field_id' =>2,
        ]);

        Setting::create([
            'organization_code' => 'wM1z4nZsIYughLausC6F',
            'id_checkin' => true,
            'automatic_id_checkin' => false,
            'sms_checkin' => true,
            'ipass_checkin' => false,
            'field_id' =>3,
        ]);

        Setting::create([
            'organization_code' => 'wM1z4nZsIYughLausC6G',
            'id_checkin' => false,
            'automatic_id_checkin' => false,
            'sms_checkin' => false,
            'ipass_checkin' => false,
            'field_id' =>4,
        ]);

        Setting::create([
            'organization_code' => 'wM1z4nZsIYughLausC6H',
            'id_checkin' => true,
            'automatic_id_checkin' => true,
            'sms_checkin' => false,
            'ipass_checkin' => false,
            'field_id' =>5,
        ]);
    }
}
