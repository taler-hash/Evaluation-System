<?php

namespace App\Services\AuthUser;
use App\Models\Admin;
use App\Models\Supervisor;
use App\Models\Coordinator;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthUser
{
    public static function Auth($username, $password){
        $admin = Admin::select('*')
        ->where('user_name','=',$username)
        ->first();

        $coordinator = Coordinator::select('*')
        ->where('status', '=','active')
        ->where('user_name','=',$username)
        ->first();

        $supervisor = Supervisor::select('*')
        ->where('status', '=','active')
        ->where('user_name','=',$username)
        ->first();

        $student = Student::select('*')
        ->where('status', '=','active')
        ->where('user_name','=',$username)
        ->first();

        if($admin && Hash::check($password, $admin->password))
        {
            session(['id' => $admin->id]);
            session(['fullName' => $admin->full_name]);
            session(['userName' => $admin->user_name]);
            session(['role' => $admin->role_id]);
            session(['roleName' => 'Admin']);
            return response()->json('success');
        }

        if($coordinator && Hash::check($password, $coordinator->password))
        {
            session(['id' => $coordinator->id]);
            session(['fullName' => $coordinator->full_name]);
            session(['userName' => $coordinator->user_name]);
            session(['role' => $coordinator->role_id]);
            session(['course' => $coordinator->course_handled]);
            session(['roleName' => 'Coordinator']);
            return response()->json('success');
        }

        if($supervisor && Hash::check($password, $supervisor->password))
        {
            session(['id' => $supervisor->id]);
            session(['fullName' => $supervisor->full_name]);
            session(['companyName' => $supervisor->company_name]);
            session(['userName' => $supervisor->user_name]);
            session(['role' => $supervisor->role_id]);
            session(['course' => $supervisor->course_handled]);
            session(['roleName' => 'Supervisor']);
            return response()->json('success');
        }

        if($student && Hash::check($password, $student->password))
        {
            session(['id' => $student->id]);
            session(['fullName' => $student->full_name]);
            session(['userName' => $student->user_name]);
            session(['role' => $student->role_id]);
            session(['course' => $student->course]);
            session(['batchYear' => $student->batch_year]);
            session(['studentNumber' => $student->student_number]);
            session(['roleName' => 'Student']);
            return response()->json('success');
        }

        abort('401', 'No Account Found');
        return response()->json('fail');
    }
}