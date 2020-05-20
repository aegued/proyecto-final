<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          =>  'Alfredo',
            'email'         =>  'egued89@gmail.com',
            'password'      =>  bcrypt('123456aA'),
            'created_at'    =>  now(),
        ]);
    }
}
