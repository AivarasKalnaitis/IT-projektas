<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'car_number' => 'ADM001',
            'first_registration_country' => 'Lietuva',
            'insurance_events_count' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'first_name' => 'Head',
            'last_name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager'),
            'car_number' => 'MNG001',
            'first_registration_country' => 'Lietuva',
            'insurance_events_count' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
