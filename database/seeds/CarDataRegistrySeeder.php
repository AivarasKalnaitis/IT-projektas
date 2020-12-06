<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CarDataRegistrySeeder extends Seeder
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
                'car_number' => 'JKM456',
                'first_registration_country' => 'Vokietija',
                'insurance_events_count' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'ETB784',
                'first_registration_country' => 'Vokietija',
                'insurance_events_count' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'OMT905',
                'first_registration_country' => 'Vokietija',
                'insurance_events_count' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'JKM457',
                'first_registration_country' => 'Vokietija',
                'insurance_events_count' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'AMT998',
                'first_registration_country' => 'Lietuva',
                'insurance_events_count' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'AOM999',
                'first_registration_country' => 'Italija',
                'insurance_events_count' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'GAL420',
                'first_registration_country' => 'Lietuva',
                'insurance_events_count' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'API069',
                'first_registration_country' => 'Ispanija',
                'insurance_events_count' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'INC001',
                'first_registration_country' => 'Italija',
                'insurance_events_count' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'INC002',
                'first_registration_country' => 'Suomija',
                'insurance_events_count' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'INC003',
                'first_registration_country' => 'Olandija',
                'insurance_events_count' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'car_number' => 'INC004',
                'first_registration_country' => 'Italija',
                'insurance_events_count' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('car_data_registry')->insert($data);
    }
}
