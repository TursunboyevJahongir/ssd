<?php

namespace Database\Seeders;

use App\Models\Cost;
use App\Models\Crime;
use App\Models\District;
use App\Models\Income;
use App\Models\Law;
use App\Models\Prisoner;
use App\Models\Region;
use App\Models\User;
use App\Models\UserAddress;
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
        User::factory(100)->create();
        Income::factory(100)->create();
        Cost::factory(100)->create();
        Region::factory(20)->create();
        District::factory(50)->create();
        UserAddress::factory(100)->create();
        Law::factory(100)->create();
        Prisoner::factory(50)->create();
        Crime::factory(200)->create();
    }
}
