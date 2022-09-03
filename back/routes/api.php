<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLeaveRquestController;
use App\Http\Controllers\UserController;
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
================= User route =====================
 */

Route::post("register", [UserController::class, "register"]);
Route::post("user/sigin", [UserController::class, "sigin"]);
Route::put("user_update_image/{id}", [UserController::class, "updateImage"]);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("/admin", [UserController::class, "store"]);
    Route::post("/userlogin", [UserController::class, "admin"]);
    Route::get("/user/{id}", [UserController::class, "show"]);
    Route::put("user_update_image/{id}", [UserController::class, "updateImage"]);
    Route::put("student_update_image/{id}", [StudentController::class, "updateImage"]);
    Route::apiresource("/student", StudentController::class);  

    Route::apiresource("/student", StudentController::class);
    Route::apiresource("/student_leave_request", StudentLeaveRquestController::class);
    Route::put("user_update_password/{id}", [UserController::class, "updatePassword"]);
    Route::get("responeMail/{leave_id}", [MailController::class, "responeLeave"]);

});

/*
================= Student route =====================
 */
Route::post("/addStudent", [StudentController::class, "store"]);
Route::post("student/sigin", [StudentController::class, "sigin"]);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiresource("/user", UserController::class);
    Route::get("/teacher", [UserController::class, "get_teacher"]);
    Route::apiresource("/student_leave_request", StudentLeaveRquestController::class);
    Route::post("sigout", [StudentController::class, "sigout"]);
    Route::get("student_through_user_id/{user_id}", [StudentController::class, "getStudent"]);
    Route::get("/student_leave_request/student/{student_id}", [StudentLeaveRquestController::class, "getLeaveByStudentId"]);
    Route::post("sigout", [StudentController::class, "sigout"]);
    Route::get("studentByUserId/{user_id}", [StudentController::class, "getStudentByuserId"]);
    Route::put("student_update", [StudentController::class, "update"]);
    Route::put("user_update_password/{id}", [UserController::class, "updatePassword"]);
    Route::put("student_update_password/{id}", [StudentController::class, "updatePassword"]);

    Route::get("userlogin", [StudentController::class, "student"]);
});
