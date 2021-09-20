<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class NewUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'arianne@owner.com',
            'fname' => 'Arianne',
            'lname' => 'Reis',
            'password' => Hash::make('123456'), // password
            'role_ID' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'email' => 'nicole@owner.com',
            'fname' => 'Nicole',
            'lname' => 'Peel',
            'password' => Hash::make('123456'), // password
            'role_ID' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'email' => 'person1@admin.com',
            'fname' => 'John',
            'lname' => 'Doe',
            'password' => Hash::make('123456'), // password
            'role_ID' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}