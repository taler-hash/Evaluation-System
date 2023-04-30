<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class coordinatorController extends Controller
{
    public function index(){
        return view('/pages/coordinator/dashboard');
    }
    //Portfolios
    public function portfolios(){
        return view('/pages/coordinator/portfolios');
    }

    //Evaluation
    public function evaluation(){
        return view('/pages/coordinator/evaluation');
    }

    //Supervisors
    public function fetchSupervisors(Request $request){
        $data = Supervisor::select('*')
        ->where('course_handled',session('course'))
        ->where('full_name','like',"%$request->searchString%")
        ->orderBy('id','desc')
        ->paginate(5);

        return response()->json($data);
    }

    public function supervisors(){
        return view('/pages/coordinator/supervisors');
    }

    public function addNewSupervisor(Request $request){
        $request->validate(
            [
                'full_name' => 'required|unique:supervisor_users,full_name|regex:/^(?!.*\.).*$/',
                'contact_number' => 'required|numeric|min:11',
                'email' => 'required|email',
                'company_name' => 'required',
                'user_name' => 'required',
                'company_position' => 'required',
                'password' => 'required|min:6',
            ],
            [
                'full_name.unique' => 'Name has already been taken',
                'contact_number.min' => 'Contact Number must be valid or 11 digits'
            ]
        );

        $data = new Supervisor();
        $data->full_name = strtolower($request->full_name);   
        $data->role_id = "3";
        $data->password =  Hash::make($request->password);
        $data->user_name = strtolower($request->user_name);
        $data->company_name = strtolower($request->company_name);
        $data->company_position = strtolower($request->company_position);
        $data->contact_number = $request->contact_number;
        $data->email = $request->email;
        $data->course_handled = session('course');
        $data->status = "active";
        $data->save();

        return response()->json('success');
    }

    public function updateSupervisor(Request $request){
        if($request->password !== null)
        {
            $request->validate(
                [
                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'contact_number' => 'required|numeric|min:11',
                    'email' => 'required|email',
                    'company_name' => 'required',
                    'company_position' => 'required',
                    'password' => 'min:6',
                ],
                [
                    'full_name.unique' => 'Name has already been taken',
                    'contact_number.min' => 'Contact Number must be valid or 11 digits'
                ]
            );

            Supervisor::where("id",$request->id)
            ->update([
                'full_name' => $request->full_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'password' => Hash::make($request->password),
                'company_position' => $request->company_position,
                'status' => $request->status
            ]);
        }
        
        Supervisor::where("id",$request->id)
        ->update([
            'full_name' => $request->full_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'company_position' => $request->company_position,
            'status' => $request->status
        ]);

        return response()->json('success');
    }

    //Students
    public function students(){
        return view('/pages/coordinator/students');
    }

    public function fetchStudents(Request $request){
        $data = Student::with(['supervisor'])
        ->where('course',session('course'))
        ->where('full_name','like',"%$request->searchString%")
        ->orWhere('company_name','like',"%$request->searchString%")
        ->orWhere('batch_year','like',"%$request->searchString%")
        ->orWhere('status','like',"%$request->searchString%")
        ->orderBy('id','desc')
        ->paginate(5);
        $course = Course::select('*')->get();
        return response()->json(['students' => $data, 'course' => $course]);
    }

    public function addNewStudent(Request $request){
        $request->validate(
            [
                'student_number' => ' required|numeric',
                'full_name' => 'required|unique:student_users,full_name|regex:/^(?!.*\.).*$/',
                'contact_number' => 'required|numeric|min:11||unique:student_users,contact_number',
                'email' => 'required|email|unique:student_users,email',
                'company_name' => 'required|exists:supervisor_users,company_name',
                'user_name' => 'required',
                'course' => 'required',
                'password' => 'required|min:6',
            ],
            [
                'company_name.exists' => 'Company Name doesnt exist',
                'full_name.unique' => 'Name has already been taken',
                'contact_number.min' => 'Contact Number must be valid or 11 digits'
            ]
        );

        $student = new Student();
        $student->student_number = $request->student_number;
        $student->full_name = $request->full_name;
        $student->company_name = $request->company_name;
        $student->user_name = $request->user_name;
        $student->batch_year = Carbon::now()->format('Y')."-".Carbon::now()->addYear()->format('Y');
        $student->email = $request->email;
        $student->contact_number = $request->contact_number;
        $student->course = $request->course;
        $student->role_id = '4';
        $student->status = 'active';
        $student->password = Hash::make($request->password);
        $student->save();

        return response()->json('success');
    }

    public function updateStudent(Request $request){
        if($request->password !== null)
        {
            $request->validate(
                [
                    'student_number' => ' required|numeric',
                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'contact_number' => 'required|numeric|min:11',
                    'email' => 'required|email',
                    'company_name' => 'required|exists:student_users,company_name',
                    'user_name' => 'required',
                    'course' => 'required',
                    'password' => 'required'
                ],
                [
                    'company_name.exists' => 'Company Name doesnt exist',
                    'full_name.unique' => 'Name has already been taken',
                    'contact_number.min' => 'Contact Number must be valid or 11 digits'
                ]
            );

            Student::where('id', $request->id)->update([
                'student_number' => $request->student_number,
                'full_name' => $request->full_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'user_name' => $request->user_name,
                'course' => $request->course,
                'password' => Hash::make($request->password),
                'status' => $request->status
            ]);
            return response()->json('success');
        }
        
        $request->validate(
            [
                'student_number' => ' required|numeric',
                'full_name' => 'required|regex:/^(?!.*\.).*$/',
                'contact_number' => 'required|numeric|min:11',
                'email' => 'required|email',
                'company_name' => 'required|exists:student_users,company_name',
                'user_name' => 'required',
                'course' => 'required',
            ],
            [
                'company_name.exists' => 'Company Name doesnt exist',
                'contact_number.min' => 'Contact Number must be valid or 11 digits'
            ]
        );

        Student::where('id', $request->id)->update([
            'student_number' => $request->student_number,
            'full_name' => $request->full_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'user_name' => $request->user_name,
            'course' => $request->course,
            'status' => $request->status
        ]);

        return response()->json('success');
    }
}
