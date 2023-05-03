<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;

use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index(){
        return view('/pages/student/student');
    }

    public function fetchPortfolio(){
        $data = Portfolio::select('*')
        ->where('student_number',session('studentNumber'))
        ->first();

        return response()->json($data);
    }

    public function viewPdf($batchYear, $fileName){
        $path = storage_path('documents/'.$batchYear.'/'.$fileName);

        return response()->fie($path);
    }
}
