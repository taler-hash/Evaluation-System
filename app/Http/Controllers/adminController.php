<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinator;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function index(){
        return view('/pages/admin/dashboard');
    }

    public function coordinator(){
        return view('/pages/admin/coordinator');
    }

    public function fetchCoordinator(Request $request){
        $data=Coordinator::select('*')
        ->where('full_name' ,'like',"%$request->searchString%")
        ->orWhere('user_name' ,'like',"%$request->searchString%")
        ->orWhere('email' ,'like',"%$request->searchString%")
        ->orWhere('status' ,'like',"%$request->searchString%")
        ->paginate(5);

        $course = Course::select('*')->get();

        return response()->json(['coordinator' => $data, 'course'=> $course]);
    }

    public function addCoordinator(Request $request){

        $request->validate(
            [
                'full_name' => 'required|unique:coordinator_users,full_name|regex:/^(?!.*\.).*$/',
                'contact_number' => 'required|numeric|min:11||unique:student_users,contact_number',
                'email' => 'required|email|unique:student_users,email',
                'user_name' => 'required|unique:coordinator_users,user_name',
                'course' => 'required',
                'password' => 'required|min:6',
            ],
            [
                'company_name.exists' => 'Company Name doesnt exist',
                'full_name.unique' => 'Name has already been taken',
                'contact_number.min' => 'Contact Number must be valid or 11 digits'
            ]
        );

        $coordinator = new Coordinator();
        $coordinator->full_name = $request->full_name;
        $coordinator->contact_number = $request->contact_number;
        $coordinator->email = $request->email;
        $coordinator->user_name = $request->user_name;
        $coordinator->course_handled = $request->course;
        $coordinator->password = Hash::make($request->password);
        $coordinator->role_id = '2';
        $coordinator->status = 'active';
        $coordinator->save();

        return response()->json('success');
    
    }

    public function updateCoordinator(Request $request){
        if($request->password !== null)
        {
            $request->validate(
                [

                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'contact_number' => 'required|numeric|min:11',
                    'email' => 'required|email',
                    'course_handled' => 'required',
                    'user_name' => 'required',
                    'password' => 'required'
                ],
                [
                    'company_name.exists' => 'Company Name doesnt exist',
                    'full_name.unique' => 'Name has already been taken',
                    'contact_number.min' => 'Contact Number must be valid or 11 digits'
                ]
            );

            Coordinator::where('id', $request->id)->update([
                'full_name' => $request->full_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'user_name' => $request->user_name,
                'course_handled' => $request->course_handled,
                'password' => Hash::make($request->password),
                'status' => $request->status
            ]);
            return response()->json('success');
        }
        
        $request->validate(
            [

                'full_name' => 'required|regex:/^(?!.*\.).*$/',
                'contact_number' => 'required|numeric|min:11',
                'email' => 'required|email',
                'course_handled' => 'required',
                'user_name' => 'required',
            ],
            [
                'full_name.unique' => 'Name has already been taken',
                'contact_number.min' => 'Contact Number must be valid or 11 digits'
            ]
        );

        Coordinator::where('id', $request->id)->update([
            'full_name' => $request->full_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'user_name' => $request->user_name,
            'course_handled' => $request->course_handled,
            'status' => $request->status
        ]);

        return response()->json('success');
    }

    public function courses(){
        return view('/pages/admin/courses');
    }

    public function fetchCourses(){
        $data = Course::all();

        return response()->json($data);
    }

    public function addCourse(Request $request){

        $request->validate(
        [
            'course' => 'required'
        ]);

        $course = new Course();
        $course->course = strtolower($request->course);
        $course->save();

        return response()->json('success');
    }

    public function deleteCourse(Request $request){

        Course::where('id', $request->id)->delete();

        return response()->json('success');
    }
}
