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

/*
================= User route=====================
 */
Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);

/*
================= Teacher route =====================
 */
Route::post("/addTeacher", [TeacherController::class, "store"]);
Route::post("teacher/sigin", [TeacherController::class, "sigin"]);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::apiresource("/user", UserController::class);
    Route::apiresource("/student", StudentController::class);
    Route::post("/addTeacher", [TeacherController::class, "store"]);
    Route::put("/update_teacher", [TeacherController::class, "update"]);
    Route::apiresource("/student_leave_request", StudentLeaveRquestController::class);
    Route::post("sigout", [TeacherController::class, "sigout"]);
    Route::get("userlogin", [TeacherController::class, "teacher"]);
    Route::put("student_update_password", [TeacherController::class, "updatePassword"]);
    Route::put("student_update_image", [TeacherController::class, "updateImage"]);
    Route::put("student_update_password", [UserController::class, "updatePassword"]);
});

/*
================= Student route =====================
 */

Route::post("/addStudent", [StudentController::class, "store"]);
Route::post("student/sigin", [StudentController::class, "sigin"]);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::apiresource("/user", UserController::class);
    Route::apiresource("/student_leave_request", StudentLeaveRquestController::class);
    Route::post("sigout", [StudentController::class, "sigout"]);
    Route::put("student_update", [StudentController::class, "update"]);
    Route::put("student_update_password", [UserController::class, "updatePassword"]);
    Route::put("student_update_password", [StudentController::class, "updatePassword"]);
    Route::put("student_update_image", [StudentController::class, "updateImage"]);
    Route::get("userlogin", [StudentController::class, "student"]);
});
