<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name'=>'Admin',
            'password'=>'$2y$10$D8svV.v5kZdR7x7J5XG0YewSJ1jeQe1wBHIxV74IY59oC5XOt52XG',
            'role'=>'1',
            'email'=>'baonguyen212002@gmail.com',
        ]);
    }
}
