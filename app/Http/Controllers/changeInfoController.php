<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Coordinator;
use App\Models\Supervisor;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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
                ->where('id', session('id'))->get();

                return response()->json($data);
            break;
            
            case(3):
                $data = Supervisor::select('*')
                ->where('id', session('id'))->get();

                return response()->json($data);
            break;

            case(4):
                $data = Student::select('*')
                ->where('id', session('id'))->get();

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
            
            Admin::where('id', $request->id)->update($updates);
    
            return response()->json('success');
        }
        if(session('role') === 2)
        {
            $request->validate(
                [
                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'user_name' => 'required',
                    'contact_number' => 'required',
                    'email' => 'required',
                ],
                [
                    'full_name.unique' => 'Name has already been taken',
                ]
            );
    
            $updates = [
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
            ];
            
            if (!is_null($request->password)) {
                $updates['password'] = Hash::make($request->password);
            }
            
            Coordinator::where('id', $request->id)->update($updates);
    
            return response()->json('success');
        }

        if(session('role') === 3)
        {
            $request->validate(
                [
                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'user_name' => 'required',
                    'contact_number' => 'required',
                    'email' => 'required',
                ],
                [
                    'full_name.unique' => 'Name has already been taken',
                ]
            );
    
            $updates = [
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
            ];
            
            if (!is_null($request->password)) {
                $updates['password'] = Hash::make($request->password);
            }
            
            Supervisor::where('id', $request->id)->update($updates);
    
            return response()->json('success');
        }
        if(session('role') === 4)
        {
            $request->validate(
                [
                    'full_name' => 'required|regex:/^(?!.*\.).*$/',
                    'user_name' => 'required',
                    'contact_number' => 'required',
                    'email' => 'required',
                ],
                [
                    'full_name.unique' => 'Name has already been taken',
                ]
            );
    
            $updates = [
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
            ];
            
            if (!is_null($request->password)) {
                $updates['password'] = Hash::make($request->password);
            }
            
            Student::where('id', $request->id)->update($updates);
    
            return response()->json('success');
        }
        
    }
}
