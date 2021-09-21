<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'role_name' => 'Owner'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => 'Admin'
        ]);
       
        User::create([
            'email' => 'NatureHeals.21@gmail.com',
             'fname' => 'Nature',
             'lname' => 'Heals',
             'password' => Hash::make('Welcome@123'),
            'role_ID' => 1
        ]);
        

        

        DB::table('tool_statuses')->insert([
            'status' => 'Hidden',
            'created_at'=> now(),
        ]);
        DB::table('tool_statuses')->insert([
            'status' => 'Published',
            'created_at'=> now(),
        ]);
        
        DB::table('tool_statuses')->insert([
            'status' => 'Draft',
            'created_at'=> now(),
        ]);
        
        DB::table('tool_statuses')->insert([
            'status' => 'Request',
            'created_at'=> now(),
        ]);
        
    }
}
