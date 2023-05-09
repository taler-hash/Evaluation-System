<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\supervisorController;
use App\Http\Controllers\coordinatorController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\changeInfoController;

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
            switch(session('role')){
                case(1):
                    return redirect('/coordinator');
                break;
                case(2):
                    return redirect('/portfolios');
                break;
                case(3):
                    return redirect('/evaluateStudents');
                break;
                case(4):
                    return redirect('/portfolio');
                break;
                default:
                    return redirect('/login');

            }

            //return view('/pages/dashboard');
        });

        //Change Information
        Route::get('/Info',[changeInfoController::class,'index']);
        Route::get('/fetchUser',[changeInfoController::class,'fetchUser']);
        Route::post('/updateUser',[changeInfoController::class,'updateUser']);

        
        //Admin
            Route::middleware('checkAdmin')->group(function(){
                //Web Routes
                Route::get('/coordinator',[adminController::class,'coordinator']);    

                //Api Routes
                Route::prefix('admin')->group(function(){

                    Route::get('/fetchCoordinator',[adminController::class,'fetchCoordinator']);
                    Route::post('/addCoordinator',[adminController::class,'addCoordinator']);
                    Route::post('/updateCoordinator',[adminController::class,'updateCoordinator']);
                });
            });
            

        //Coordinator
            Route::middleware('checkCoordinator')->group(function(){
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
                    Route::get('/getAllDeadline', [coordinatorController::class,'getAllDeadline']);
                    Route::get('/fetchStudentsPortfolio',[coordinatorController::class,'fetchStudentsPortfolio']);
                    Route::post('/addComment',[coordinatorController::class,'addComment']);
                    Route::post('/approvePortfolio', [coordinatorController::class,'approvePortfolio']);
                    Route::post('/setDeadline', [coordinatorController::class,'setDeadline']);
                });
            });
            

        //Supervisor
            Route::middleware('checkSupervisor')->group(function(){
                //Web Routes
                Route::get('/evaluateStudents',[supervisorController::class,'evaluateStudents']);
                        
                //Api Routes
                Route::prefix('supervisor')->group(function(){
                    Route::get('/fetchStudents',[supervisorController::class,'fetchStudents']);
                    Route::post('/weeklyCommentStudents',[supervisorController::class,'weeklyCommentStudents']);
                });
            });
            

        //Student
            Route::middleware('checkStudent')->group(function(){
                //Web Routes
                Route::get('/portfolio',[studentController::class,'index']);

                //Api Routes
                Route::prefix('student')->group(function(){
                    Route::get('/fetchPortfolio',[studentController::class,'fetchPortfolio']);
                    Route::get('/fetchDeadline',[studentController::class,'fetchDeadline']);
                    Route::get('/viewPdf/{batchYear}/{portfolioName}',[studentController::class,'viewPdf']);
                    Route::post('/uploadDocument',[studentController::class,'uploadDocument']);
                });
            });
                    
    });

Route::post('/logOut', [loginController::class,'logOut']);
Route::get('/login',[loginController::class, 'index']);
Route::post('/loginSubmit',[loginController::class,'submit']);