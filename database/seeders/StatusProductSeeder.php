<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_product')->insert(array(
            array(
                'status_product' => 'available'
            ),
            array(
                'status_product' => 'not available'
            )
        ));
    }
}
