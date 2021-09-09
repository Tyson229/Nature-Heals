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
        // \App\Models\User::factory(10)->create();
        DB::table('roles')->insert([
            'id' => 1,
            'role_name' => 'Owner'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => 'Admin'
        ]);
        User::factory()->count(5)->create();
    }
}
