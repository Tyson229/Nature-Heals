<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class NewUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'tyson@gmail.com',
            'fname' => 'Khoa',
            'lname' => 'Nguyen',
            'password' => Hash::make('123456'), // password
            'role_ID' => rand(1,2),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
