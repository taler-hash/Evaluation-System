<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_users')->insert([
            'admin_id' => '1',
            'full_name' => 'Renemer',
            'user_name' => 'renemer.dedasi',
            'role_id' => '1',
            'password' =>  Hash::make('password')
        ]);
    }
}
