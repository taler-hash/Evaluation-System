<?php

namespace App\Http\Controllers;
use App\Services\AuthUser\AuthUser;
use Illuminate\Http\Request;
class loginController extends Controller
{
    public function index(){
        if(session()->has('role'))
        {
            return redirect('/dashboard');
        }
        else
        {
            return view('/pages/login/login');
        }
       
    }

    public function submit(Request $request){
        
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );
        AuthUser::Auth($request->username, $request->password);
    }

    public function logOut(){
        session()->flush();

        return response()->json("success");
    }
}
