<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'organization_code' => 'wM1z4nZsIYughLausC6D',
            'id_checkin' => true,
            'automatic_id_checkin' => true,
            'sms_checkin' => true,
            'ipass_checkin' => true,
        ]);

        Subscription::create([
            'organization_code' => 'wM1z4nZsIYughLausC6E',
            'id_checkin' => false,
            'automatic_id_checkin' => true,
            'sms_checkin' => false,
            'ipass_checkin' => true,
        ]);

        Subscription::create([
            'organization_code' => 'wM1z4nZsIYughLausC6F',
            'id_checkin' => true,
            'automatic_id_checkin' => false,
            'sms_checkin' => true,
            'ipass_checkin' => false,
        ]);

        Subscription::create([
            'organization_code' => 'wM1z4nZsIYughLausC6G',
            'id_checkin' => false,
            'automatic_id_checkin' => false,
            'sms_checkin' => false,
            'ipass_checkin' => false,
        ]);

        Subscription::create([
            'organization_code' => 'wM1z4nZsIYughLausC6H',
            'id_checkin' => true,
            'automatic_id_checkin' => true,
            'sms_checkin' => false,
            'ipass_checkin' => false,
        ]);
    }
}
