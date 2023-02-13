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
                'visitor_type_id' => 2,
                'purpose_id' => 3,
                'sentry_id' => 4,
                'nationality_id' => 5,
                'resident_id' => 6,
                'time_log_id' => 7
            ],
            [
                'name' => 'Jane Smith',
                'type' => 'driveIn',
                'identification_type_id' => 1,
                'visitor_type_id' => 3,
                'purpose_id' => 2,
                'sentry_id' => 4,
                'nationality_id' => 5,
                'resident_id' => 6,
                'time_log_id' => 8
            ],
            [
                'name' => 'Jim Brown',
                'type' => 'walkIn',
                'identification_type_id' => 2,
                'visitor_type_id' => 1,
                'purpose_id' => 3,
                'sentry_id' => 5,
                'nationality_id' => 5,
                'resident_id' => 6,
                'time_log_id' => 9
            ],
        ];

        foreach ($visitors as $visitor) {
            Visitor::create($visitor);
        }

    }
}
