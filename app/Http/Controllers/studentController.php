<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;
use Storage;
use Illuminate\Http\Response;

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

    public function viewPdf(Request $request){
        $fileContents = Storage::disk('portfolio')->get("$request->batchYear/".session('course')."/"."$request->portfolioName");

        return new Response($fileContents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$request->portfolioName.'"',
        ]);
    }

    public function uploadDocument(Request $request){
        $request->validate(
        [
            'pdf' => 'required:|mimetypes:application/pdf'
        ],
        [
            'pdf.required' => 'Must have Uploaded File'
        ]
        );
        if(is_null(Portfolio::select('student_number')->where('student_number',session('studentNumber'))->first()));
        {
            Portfolio::where('student_number',session('studentNumber'))
            ->update([
                'portfolio_name' => "Portfolio_".session('batchYear')."_".session('course')."_".preg_replace('/\s+/', '_', session('fullName')) . ".pdf"
            ]);
        }
        $portfolio = new Portfolio();
        $portfolio->student_number = session('studentNumber');
        $portfolio->portfolio_name = "Portfolio_".session('batchYear')."_".session('course')."_".preg_replace('/\s+/', '_', session('fullName')) . ".pdf";
        $portfolio->status = 'submitted';
        $portfolio->save();

        $pdf = $request->file('pdf');
        $folderPath = session('batchYear') . "/" . session('course') . "/" . "Portfolio_".session('batchYear')."_".session('course')."_".preg_replace('/\s+/', '_', session('fullName')) . ".pdf";
        Storage::disk('portfolio')->put($folderPath,file_get_contents($pdf));

        return response()->json('success');
    }
}
