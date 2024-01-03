<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('users')->insert([
            [
                'full_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => app('hash')->make('Admin@2023'),
                'gender' => 1,
                'dob' => '1997-09-04',
                'phone' => '0907 000 000',
                'address' => 'Tân Hiệp - Kiên Giang',
                'gender' => 1,
                'position' => 0,
            ],
        ]);
    }
}
