<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class supervisorController extends Controller
{
    public function index(){
        return view('/pages/supervisor/dashboard');
    }

    public function evaluateStudents(){
        return view('/pages/supervisor/evaluateStudents');
    }

    public function fetchStudents(Request $request){
        $data = Student::select('*')
        ->where('company_name',session('companyName'))
        ->where(function($q) use ($request){
            $q->where('full_name','like',"%$request->searchString%")
            ->orWhere('company_name','like',"%$request->searchString%")
            ->orWhere('batch_year','like',"%$request->searchString%")
            ->orWhere('status','like',"%$request->searchString%");
            
        })
        ->orderBy('id','desc')
        ->paginate(5);

        return response()->json($data);
    }
}
