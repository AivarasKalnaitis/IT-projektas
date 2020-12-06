<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParameterInsuranceSeeder extends Seeder
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
                'parameter_id' => 1,
            ],
            [
                'insurance_id' => 1,
                'parameter_id' => 4,
            ],
            [
                'insurance_id' => 2,
                'parameter_id' => 2,
            ],
            [
                'insurance_id' => 2,
                'parameter_id' => 5,
            ],
            [
                'insurance_id' => 3,
                'parameter_id' => 3,
            ],
            [
                'insurance_id' => 3,
                'parameter_id' => 6,
            ],
            [
                'insurance_id' => 4,
                'parameter_id' => 3,
            ],
            [
                'insurance_id' => 4,
                'parameter_id' => 7,
            ],
        ];
        DB::table('parameter_insurance')->insert($data);
    }
}
