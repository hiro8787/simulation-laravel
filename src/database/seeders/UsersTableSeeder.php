<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        'name' => '山口',
        'email' => 'yamaguchi@gmail.com',
        'password' => 'yamaguchi5689',
        ];
        DB::table('users')->insert($param);
        $param = [
        'name' => '山田',
        'email' => 'yamada@gmail.com',
        'password' => 'yamada6498',
        ];
        DB::table('users')->insert($param);
    }
}
