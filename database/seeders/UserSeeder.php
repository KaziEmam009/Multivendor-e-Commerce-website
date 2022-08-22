<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Kazi Emam',
            'email' => 'kaziemam007@gmail.com',
            'password' => Hash::make('01775536198'),
            'role' => 2,
            'created_at' => Carbon::now(),
            ]);
    }
}
