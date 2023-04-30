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
        $admin = Admin::select('full_name', 'password','role_id')
        ->where('user_name','=',$username)
        ->first();

        $coordinator = Coordinator::select('full_name', 'course_handled' ,'password','role_id')
        ->where('user_name','=',$username)
        ->first();

        $supervisor = Supervisor::select('full_name', 'course_handled' , 'password','role_id','company_name')
        ->where('user_name','=',$username)
        ->first();

        $student = Student::select('full_name','user_name', 'password','role_id')
        ->where('user_name','=',$username)
        ->first();

        if($admin && Hash::check($password, $admin->password))
        {
            session(['fullName' => $admin->full_name]);
            session(['userName' => $admin->user_name]);
            session(['role' => $admin->role_id]);
            session(['roleName' => 'Admin']);
            return response()->json('success');
        }

        if($coordinator && Hash::check($password, $coordinator->password))
        {
            session(['fullName' => $coordinator->full_name]);
            session(['userName' => $coordinator->user_name]);
            session(['role' => $coordinator->role_id]);
            session(['course' => $coordinator->course_handled]);
            session(['roleName' => 'Coordinator']);
            return response()->json('success');
        }

        if($supervisor && Hash::check($password, $supervisor->password))
        {
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
            session(['fullName' => $student->full_name]);
            session(['userName' => $student->user_name]);
            session(['role' => $student->role_id]);
            session(['course' => $student->course]);
            session(['roleName' => 'Student']);
            return response()->json('success');
        }

        abort('401', 'No Account Found');
        return response()->json('fail');
    }
}