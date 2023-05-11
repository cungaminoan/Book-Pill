<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery')->insert(array(
            array(
                'delivery_from' => 'TP. Ha Noi'
            ),
            array(
                'delivery_from' => 'TP. Ho Chi Minh'
            )
        ));
    }
}
