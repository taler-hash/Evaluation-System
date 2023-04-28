<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_users')->insert([
            'admin_id' => '1',
            'full_name' => 'juan delacruz',
            'user_name' => 'test.admin',
            'role_id' => '1',
            'password' =>  Hash::make('password')
        ]);

        DB::table('coordinator_users')->insert([
            'coordinator_id' => '1',
            'full_name' => 'pepito manaloto',
            'user_name' => 'test.coordinator',
            'role_id' => '2',
            'password' =>  Hash::make('password'),
            'course_handled' => 'bsit',
            'contact_number' => '0912345678',
            'email' => 'pepitomanaloto@gmail.com',
            'status' => 'active'
        ]);

        DB::table('supervisor_users')->insert([
            'supervisor_id' => '1',
            'full_name' => 'albert pablo',
            'user_name' => 'test.supervisor',
            'role_id' => '3',
            'password' =>  Hash::make('password'),
            'company_name' => 'Lex Mark inc.',
            'company_position' => 'IT Lead',
            'contact_number' => '091234566789',
            'email' => 'albertpablo@gmail.com',
            'status' => 'active'
        ]);

        DB::table('student_users')->insert([
            'student_number' => '1',
            'full_name' => 'renemer dedasi',
            'user_name' => 'test.student',
            'role_id' => '4',
            'password' =>  Hash::make('password'),
            'course' => 'bsit',
            'status' => 'active'
        ]);
    }
    
}
