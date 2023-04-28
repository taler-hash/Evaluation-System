<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\Coordinator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class coordinatorController extends Controller
{
    public function index(){
        return view('/pages/coordinator/dashboard');
    }
    //Portfolios
    public function portfolios(){
        return view('/pages/coordinator/portfolios');
    }

    //Supervisors
    public function fetchSupervisors(Request $request){

        $data = Supervisor::select('*')
        ->where('full_name','like',"%$request->searchString%")
        ->orderBy('id','desc')
        ->paginate(10);

        return response()->json($data);
    }

    public function supervisors(){
        return view('/pages/coordinator/supervisors');
    }

    //Students
    public function students(){
        return view('/pages/coordinator/students');
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
                'password' => 'required',
            ],
            [
                'full_name.unique' => 'Name has already been taken',
                'contact_number.min' => 'Contact Number must be valid or 11 digits'
            ]
        );

        $data = new Supervisor();
        $data->full_name = $request->full_name;   
        $data->role_id = "3";
        $data->password =  Hash::make($request->password);
        $data->user_name = $request->user_name;
        $data->company_name = $request->company_name;
        $data->company_position = $request->company_position;
        $data->contact_number = $request->contact_number;
        $data->email = $request->email;
        $data->status = "active";
        $data->save();

        return response()->json('success');
    }
}
