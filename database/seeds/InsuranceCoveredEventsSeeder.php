<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceCoveredEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'event' => 'avarija',
            ],
            [
                'event' => 'sprogimas',
            ],
            [
                'event' => 'gaisras',
            ],
            [
                'event' => 'vagyste',
            ],
            [
                'event' => 'skendimas',
            ],
            [
                'event' => 'apibraizymas',
            ],
        ];

        DB::table('insurance_covered_events')->insert($data);
    }
}
