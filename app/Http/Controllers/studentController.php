<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;
use App\Models\Deadline;
use Storage;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index(){
        return view('/pages/student/portfolio');
    }

    public function fetchPortfolio(){
        $data = Portfolio::select('*')
        ->where('student_number',session('studentNumber'))
        ->first();

        return response()->json($data);
    }
    
    public function fetchDeadline(){
        $data = Deadline::select('*')->where('batch_year',session('batchYear'))->get();

        return response()->json($data);
    }

    public function viewPdf($batchYear, $portfolioName){
        $fileContents = Storage::disk('portfolio')->get("$batchYear/".session('course')."/"."$portfolioName");

        return new Response($fileContents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$portfolioName.'"',
        ]);
    }

    public function uploadDocument(Request $request){
        
        $request->validate(
        [
            'pdf' => 'required:|mimetypes:application/pdf'
        ],
        [
            'pdf.required' => 'Must a upload a File'
        ]
        );
        if(Portfolio::where('student_number', session('studentNumber'))->exists() && is_null(Portfolio::select('student_number')->where('student_number',session('studentNumber'))->first()->portfolio_name))
        {
            Portfolio::where('student_number',session('studentNumber'))
            ->update([
                'portfolio_name' => "Portfolio_".session('batchYear')."_".session('course')."_".preg_replace('/\s+/', '_', session('fullName')) . ".pdf",
                'status' => $request->status,
                'comment' => null
            ]);
            return response()->json('success');
        }
        $portfolio = new Portfolio();
        $portfolio->student_number = session('studentNumber');
        $portfolio->portfolio_name = "Portfolio_".session('batchYear')."_".session('course')."_".preg_replace('/\s+/', '_', session('fullName')) . ".pdf";
        $portfolio->status = $request->status;
        $portfolio->save();

        $pdf = $request->file('pdf');
        $folderPath = session('batchYear') . "/" . session('course') . "/" . "Portfolio_".session('batchYear')."_".session('course')."_".preg_replace('/\s+/', '_', session('fullName')) . ".pdf";
        Storage::disk('portfolio')->put($folderPath,file_get_contents($pdf));

        return response()->json('success');
    }
}
