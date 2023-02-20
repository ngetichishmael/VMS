<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class VisitorSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visitors = [
            [
                'name' => 'John Doe',
                'type' => 'walkIn',
                'identification_type_id' => 1,
                'visitor_type_id' => 1,
                'purpose_id' => 1,
                'sentry_id' => 1,
                'nationality_id' => 1,
                'resident_id' => 1,
                'time_log_id' => 1,
                'tag'=>'123',
            ],
            [
                'name' => 'Jane Smith',
                'type' => 'driveIn',
                'identification_type_id' => 2,
                'visitor_type_id' => 2,
                'purpose_id' => 2,
                'sentry_id' => 2,
                'nationality_id' => 2,
                'resident_id' => 2,
                'time_log_id' => 2,
                'tag'=>'122',

            ],
            [
                'name' => 'kibet tanui',
                'type' => 'sms',
                'identification_type_id' => 3,
                'visitor_type_id' => 3,
                'purpose_id' => 3,
                'sentry_id' => 2,
                'nationality_id' => 3,
                'resident_id' => 3,
                'time_log_id' => 3,
                'tag'=>'1092',

            ]
        ];

        foreach ($visitors as $visitor) {
            Visitor::create($visitor);
        }

    }
}
