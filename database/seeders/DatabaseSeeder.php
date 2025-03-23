<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
USE Database\Seeders\ClientSeeder;
USE Database\Seeders\ProductSeeder;
USE Database\Seeders\ClientProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            ProductSeeder::class,
            ClientProductSeeder::class,
        ]);
    }
}
