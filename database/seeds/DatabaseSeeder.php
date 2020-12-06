<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RoleTableSeeder::class,
            UsersRoleTableSeeder::class,
            InsurancePlansSeeder::class,
            InsuranceCoveredEventsSeeder::class,
            CarParamsSeeder::class,
            ParameterInsuranceSeeder::class,
            InsuranceEventsSeeder::class,
            CarDataRegistrySeeder::class,
            CarDataParametersSeeder::class,
        ]);
    }
}
