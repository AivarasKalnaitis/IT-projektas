<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarDataParametersSeeder extends Seeder
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
                'car_data_id' => 1,
                'parameter_id' => 1,
            ],
            [
                'car_data_id' => 1,
                'parameter_id' => 4,
            ],
            [
                'car_data_id' => 2,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 2,
                'parameter_id' => 5,
            ],
            [
                'car_data_id' => 3,
                'parameter_id' => 3,
            ],
            [
                'car_data_id' => 3,
                'parameter_id' => 6,
            ],
            [
                'car_data_id' => 4,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 5,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 6,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 4,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 7,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 8,
                'parameter_id' => 2,
            ],
            [
                'car_data_id' => 8,
                'parameter_id' => 5,
            ],
            [
                'car_data_id' => 9,
                'parameter_id' => 1,
            ],
            [
                'car_data_id' => 10,
                'parameter_id' => 1,
            ],
            [
                'car_data_id' => 10,
                'parameter_id' => 5,
            ],
            [
                'car_data_id' => 12,
                'parameter_id' => 3,
            ]
        ];

        DB::table('table_parameters_car_data_pivot')->insert($data);
    }
}
