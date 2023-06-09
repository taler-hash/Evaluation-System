<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_users')->insert([
            'full_name' => 'juan delacruz',
            'user_name' => 'test.admin',
            'role_id' => '1',
            'password' =>  Hash::make('password')
        ]);

        DB::table('coordinator_users')->insert([
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
            'full_name' => 'albert pablo',
            'user_name' => 'test.supervisor',
            'role_id' => '3',
            'password' =>  Hash::make('password'),
            'company_name' => 'lex mark inc.',
            'company_position' => 'it lead',
            'contact_number' => '091234566789',
            'course_handled' => 'bsit',
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
            'status' => 'active',
            'email' => 'test@gmail.com',
            'contact_number' => '12345678901',
            'batch_year' => '2023',
            'company_name' => 'lex mark inc.'
        ]);

        DB::table('comments')->insert([
            'student_number' => '1',
            'comment' => 'hes doing good',
            'rating' => 'excellent',
            'evaluated_at' => now()->format('d/m/Y')
        ]);

        DB::table('deadline')->insert([
            'batch_year' => '2023',
            'date' => '05/08/2023',
        ]);

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

        DB::table('course')->insert([
            'course' => 'bsit'
        ]);
        DB::table('course')->insert([
            'course' => 'ba-polsci'
        ]);
        DB::table('course')->insert([
            'course' => 'bshm'
        ]);
        DB::table('course')->insert([
            'course' => 'bshrm'
        ]);
        DB::table('course')->insert([
            'course' => 'bsba'
        ]);
        DB::table('course')->insert([
            'course' => 'bsed'
        ]);
        DB::table('course')->insert([
            'course' => 'beed'
        ]);
    }
    
}
