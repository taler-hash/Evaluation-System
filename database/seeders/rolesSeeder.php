<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role_id' => '1',
            'role_name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'role_id' => '2',
            'role_name' => 'coordinator',
        ]);
        DB::table('roles')->insert([
            'role_id' => '3',
            'role_name' => 'supervisor',
        ]);
        DB::table('roles')->insert([
            'role_id' => '4',
            'role_name' => 'student',
        ]);
        
    }
}
