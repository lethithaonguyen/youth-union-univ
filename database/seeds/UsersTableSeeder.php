<?php

use Illuminate\Database\Seeder;

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
         	'DOANVIEN_THANHNIEN_ID' => 1,
         	'VAITRO_ID' => 1,
         	'TAOMOI' => '2019-11-09 15:16:16',
            'CAPNHAT' => '2019-11-09 15:16:16',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
