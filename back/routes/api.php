<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLeaveRquestController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::delete('/student/{id}', [StudentController::class, 'destroy']);
Route::post("addstudent", [StudentController::class, "createAccount"]);

Route::post("login", [StudentController::class, "userLogin"]);

//Student private routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("logout", [StudentController::class, "logout"]);
    Route::get("userLogin", [StudentController::class, "user"]);
    Route::apiresource("studentleaveRequest", StudentLeaveRquestController::class);
    Route::put('/student/password/update/{id}', [StudentController::class, 'updatePassword']);

});

/*
================= Teacher =====================
 */

Route::post('/teachers', [TeacherController::class, 'store']);
Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/{id}', [TeacherController::class, 'show']);
Route::put('/teachers/{id}', [TeacherController::class, 'update']);
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);
Route::get('/sendMail',[MailController::class,"sendEmail"]);
