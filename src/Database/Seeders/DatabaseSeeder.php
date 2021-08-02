<?php

namespace Tir\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'        => '1',
            'user_id'   => '1',
            'name'      => 'admin',
            'email'     => 'admin@tir.loc',
            'password'  => bcrypt('123456'),
            'api_token' => 'a',
            'type'      => 'admin',
            'status'    => 'enabled',
        ]);

    }
}
