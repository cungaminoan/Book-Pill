<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(AgeRangeSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(StatusProductSeeder::class);
        $this->call(StatusOrderSeeder::class);
    }
}
