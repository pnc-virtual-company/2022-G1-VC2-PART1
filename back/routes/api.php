<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLeaveRquestController;
use Laravel\Sanctum\Sanctum;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/student', [StudentController::class, 'store']);
Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

Route::post('/studentleaveRequest', [StudentLeaveRquestController::class, 'store']);
Route::get('/studentleaveRequest', [StudentLeaveRquestController::class, 'index']);
Route::get('/studentleaveRequest/{id}', [StudentLeaveRquestController::class, 'show']);
Route::put('/studentleaveRequest/{id}', [StudentLeaveRquestController::class, 'update']);
Route::delete('/studentleaveRequest/{id}', [StudentLeaveRquestController::class, 'destroy']);

Route::post("accouter", [StudentController::class, "createAccount"]);

Route::post("login", [StudentController::class, "userLogin"]);

// // private routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post("logout", [StudentController::class, "logout"]);
    
});
