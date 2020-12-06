<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'insurance_id' => 1,
                'event_id' => 1,
            ],
            [
                'insurance_id' => 1,
                'event_id' => 2,
            ],
            [
                'insurance_id' => 1,
                'event_id' => 3,
            ],
            [
                'insurance_id' => 2,
                'event_id' => 4,
            ],
            [
                'insurance_id' => 2,
                'event_id' => 5,
            ],
            [
                'insurance_id' => 2,
                'event_id' => 6,
            ],
            [
                'insurance_id' => 3,
                'event_id' => 1,
            ],
            [
                'insurance_id' => 3,
                'event_id' => 3,
            ],
            [
                'insurance_id' => 3,
                'event_id' => 5,
            ],
            [
                'insurance_id' => 4,
                'event_id' => 2,
            ],
            [
                'insurance_id' => 4,
                'event_id' => 5,
            ],
            [
                'insurance_id' => 4,
                'event_id' => 6,
            ],

        ];

        DB::table('insurance_events')->insert($data);
    }
}
