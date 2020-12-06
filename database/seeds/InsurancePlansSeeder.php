<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsurancePlansSeeder extends Seeder
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
                'name' => 'AUTOROBO draudimas',
                'years_of_experience' => 5,
                'months_count' => 3,
                'discount' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Draudimas.lt',
                'years_of_experience' => 8,
                'months_count' => 6,
                'discount' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'BGA mašinos draudimas',
                'years_of_experience' => 3,
                'months_count' => 12,
                'discount' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'E-draudimas',
                'years_of_experience' => 4,
                'months_count' => 12,
                'discount' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('insurance_plans')->insert($data);
    }
}
