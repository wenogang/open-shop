<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ProduitSeeder;
use Database\Seeders\CategorySeeder;

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

            ProduitSeeder::class,
            CategorySeeder::class,
            RoleSeeder::class,
        ]);
         \App\Models\User::factory(10)->create();
    }
}
