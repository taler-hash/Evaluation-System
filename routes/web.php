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

            //Api Routes
            Route::prefix('coordinator')->group(function(){
                Route::get('/fetchSupervisors',[coordinatorController::class,'fetchSupervisors']);
                Route::post('/addNewSupervisor',[coordinatorController::class,'addNewSupervisor']);
            });

        //Supervisor
        Route::prefix('supervisor')->group(function(){
        });

        //Student
        Route::prefix('student')->group(function(){
        });

        
    });









Route::post('/logOut', [loginController::class,'logOut']);
Route::get('/login',[loginController::class, 'index']);
Route::post('/loginSubmit',[loginController::class,'submit']);