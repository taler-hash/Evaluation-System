<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;

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
                'firstname' => 'required',
                'lastname' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'company' => 'required',
                'position' => 'required',
                'password' => 'required',
            ]
        );
    }
}
