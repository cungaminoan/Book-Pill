<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_order')->insert(array(
            array(
                'status_order' => 'in progress'
            ),
            array(
                'status_order' => 'accept'
            ),
            array(
                'status_order' => 'deny'
            )
        ));
    }
}
