<?php

namespace Database\Seeders;

use App\Models\Specialized;
use Illuminate\Database\Seeder;

class SpecializedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialized::factory('5')->create();
    }
}
