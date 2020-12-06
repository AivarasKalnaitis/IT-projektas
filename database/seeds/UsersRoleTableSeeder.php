<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('user_role')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);
    }
}
