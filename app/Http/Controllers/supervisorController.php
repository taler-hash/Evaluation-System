<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class supervisorController extends Controller
{
    public function index(){
        return view('/pages/supervisor/dashboard');
    }

    public function evaluateStudents(){
        return view('/pages/supervisor/evaluateStudents');
    }

    public function weeklyCommentStudents(Request $request){

        $request->validate(
            [
                'comment' => 'required',
                'rating' => 'required'
            ]
        );

        $comment = new Comment();
        $comment->student_number = $request->student_number;
        $comment->rating = $request->rating;
        $comment->comment = $request->comment;
        $comment->evaluated_at = Carbon::now()->format('m/d/Y');
        $comment->save();

        return response()->json('success');
    }

    public function fetchStudents(Request $request){
        $data = Student::with(['supervisor', 
        'comments' => function($q){
            $q->orderBy('id','desc');
        }])
        ->where('company_name', session('companyName'), function($q) use ($request){
            $q->where('course',session('course'), function($q) use($request){
                $q->orWhere('full_name','like',"%$request->searchString%")
                ->orWhere('company_name','like',"%$request->searchString%")
                ->orWhere('batch_year','like',"%$request->searchString%")
                ->orWhere('status','like',"%$request->searchString%");
            });
        })
        ->paginate(5);
        return response()->json($data);
    }
}
