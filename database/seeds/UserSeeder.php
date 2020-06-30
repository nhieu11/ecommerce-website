<?php

use Illuminate\Database\Seeder;

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
           'name'=>'leo',
           'email'=>'leo2@mail.com',
            'password'=>'123123123'
       ]);
    }
}
