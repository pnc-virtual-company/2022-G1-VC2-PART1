<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
Route::put('/student/password/update/{id}', [StudentController::class, 'updatePassword']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

Route::post('/studentleaveRequest', [StudentLeaveRquestController::class, 'store']);
Route::get('/studentleaveRequest', [StudentLeaveRquestController::class, 'index']);
Route::get('student/leaveRequest/{id}', [StudentLeaveRquestController::class, 'show']);
Route::put('/studentleaveRequest/{id}', [StudentLeaveRquestController::class, 'update']);
Route::delete('/studentleaveRequest/{id}', [StudentLeaveRquestController::class, 'destroy']);

Route::post("addstudent", [StudentController::class, "createAccount"]);

Route::post("login", [StudentController::class, "userLogin"]);

// // private routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post("logout", [StudentController::class, "logout"]);
    Route::get("userLogin", [StudentController::class, "user"]);
});


/*
================= Teacher =====================
 */

Route::post('/teachers', [TeacherController::class, 'store']);
Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/{id}', [TeacherController::class, 'show']);
Route::put('/teachers/{id}', [TeacherController::class, 'update']);
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);