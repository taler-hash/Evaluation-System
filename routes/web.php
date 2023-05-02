<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\supervisorController;
use App\Http\Controllers\coordinatorController;
use App\Http\Controllers\studentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Login 

    Route::get('/',function(){
        return redirect('/dashboard');
    });
    Route::middleware('checkUser')->group(function(){

        //Dashboard
        Route::get('/dashboard',function(){
            return view('/pages/dashboard');
        });
        
        //Admin
        Route::prefix('admin')->group(function(){
        });

        //Coordinator
        
            //Web Routes
            Route::get('/portfolios',[coordinatorController::class,'portfolios']);
            Route::get('/supervisors',[coordinatorController::class,'supervisors']);
            Route::get('/students',[coordinatorController::class,'students']);
            Route::get('/evaluation',[coordinatorController::class,'evaluation']);

            //Api Routes
            Route::prefix('coordinator')->group(function(){

                //Supervisor Side
                Route::get('/fetchSupervisors',[coordinatorController::class,'fetchSupervisors']);
                Route::post('/addNewSupervisor',[coordinatorController::class,'addNewSupervisor']);
                Route::post('/updateSupervisor',[coordinatorController::class,'updateSupervisor']);

                //Student Side
                Route::get('/fetchStudents',[coordinatorController::class,'fetchStudents']);
                Route::post('/addNewStudent',[coordinatorController::class,'addNewStudent']);
                Route::post('/updateStudent',[coordinatorController::class,'updateStudent']);

                //Evaluation Side
                Route::get('/fetchEvaluatedStudents',[coordinatorController::class,'fetchEvaluatedStudents']);

                //Portfolio Side
                Route::get('/getAllBatchYears', [coordinatorController::class,'getAllBatchYears']);
                Route::get('/fetchStudentsPortfolio',[coordinatorController::class,'fetchStudentsPortfolio']);
            });

        
        //Supervisor

            //Web Routes
            Route::get('/evaluateStudents',[supervisorController::class,'evaluateStudents']);
                    
            //Api Routes
            Route::prefix('supervisor')->group(function(){
                Route::get('/fetchStudents',[supervisorController::class,'fetchStudents']);
                Route::post('/weeklyCommentStudents',[supervisorController::class,'weeklyCommentStudents']);
            });

        //Student
        Route::prefix('student')->group(function(){
        });

        
    });



Route::post('/logOut', [loginController::class,'logOut']);
Route::get('/login',[loginController::class, 'index']);
Route::post('/loginSubmit',[loginController::class,'submit']);