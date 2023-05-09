<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Coordinator;
use App\Models\Supervisor;
use App\Models\Student;
use Illuminate\Validation\Rule;

class changeInfoController extends Controller
{
    public function index(){
        return view('/pages/changeInfo/index');
    }

    public function fetchUser(){
        switch(session('role')){
            case(1):
                 $data = Admin::all();

                return response()->json($data);
            break;

            case(2):
                $data = Coordinator::select('*')
                ->where('full_name', session('fullName'))->get();

                return response()->json($data);
            break;
            
            case(3):
                $data = Supervisor::select('*')
                ->where('full_name', session('fullName'))->get();

                return response()->json($data);
            break;

            case(4):
                $data = Student::select('*')
                ->where('full_name', session('fullName'))->get();

                return response()->json($data);
            break;

            default:
                return respose()->json("fail"); 
        }
    }

    public function updateUser(Request $request){
        
        if(session('role') === 1)
        {
            $request->validate(
                [
                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'user_name' => 'required',
                    'password' => 'nullable'
                ],
                [
                    'full_name.unique' => 'Name has already been taken',
                ]
            );
    
            $updates = [
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
            ];
            
            if (!is_null($request->password)) {
                $updates['password'] = Hash::make($request->password);
            }
            
            Admin::where('full_name', session('fullName'))->update($updates);
    
            return response()->json('success');
        }
        
    }
}
