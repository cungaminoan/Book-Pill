<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
                'full_name' => 'shyawannalove',
                'username' => 'shya',
                'phone_number' => '0964343115',
                'date_of_birth' => Carbon::parse('10-12-2001')->format('Y-m-d'),
                'email' => 'shyawannalove@gmail.com',
                'password' => sha1('admin'),
                'gender' => 1,
                'role' => 2,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'full_name' => 'Admin BookPill',
                'username' => 'Admin BookPill',
                'phone_number' => '0964343115',
                'date_of_birth' => Carbon::parse('10-12-2001')->format('Y-m-d'),
                'email' => 'cungaminoan@gmail.com',
                'password' => sha1('admin'),
                'gender' => 1,
                'role' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        ));
    }
}
