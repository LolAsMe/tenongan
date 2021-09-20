<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\KasSeeder;
// use Database\Seeders\ProdusenSeeder;
// use Database\Seeders\UserSeeder;

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
        $this->call([
            KasSeeder::class,
            // ProdusenSeeder::class,
            UserSeeder::class
        ]);
    }
}
