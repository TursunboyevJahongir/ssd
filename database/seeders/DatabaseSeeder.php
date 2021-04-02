<?php

namespace Database\Seeders;

use App\Models\Cost;
use App\Models\Income;
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
//         Income::factory(20)->create();
         Cost::factory(100)->create();
    }
}
