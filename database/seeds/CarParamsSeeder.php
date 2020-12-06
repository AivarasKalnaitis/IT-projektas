<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarParamsSeeder extends Seeder
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
                'parameter' => 'Galia',
                'value' => '60'
            ],
            [
                'parameter' => 'Galia',
                'value' => '120'
            ],
            [
                'parameter' => 'Galia',
                'value' => '200'
            ],
            [
                'parameter' => 'Variklio tūris',
                'value' => '1.2'
            ],
            [
                'parameter' => 'Variklio tūris',
                'value' => '1.6'
            ],
            [
                'parameter' => 'Variklio tūris',
                'value' => '2.0'
            ],
            [
                'parameter' => 'Variklio tūris',
                'value' => '3.0'
            ]
        ];

        DB::table('car_parameters')->insert($data);
    }
}
