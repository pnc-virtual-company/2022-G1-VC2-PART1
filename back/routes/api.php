<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLeaveRquestController;
use App\Http\Controllers\UserController;
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
================= User route =====================
 */

Route::post("register", [UserController::class, "register"]);
Route::post("user/sigin", [UserController::class, "sigin"]);
Route::put("user_update_image/{id}", [UserController::class, "updateImage"]);

/*
================= Teacher route =====================
 */
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post("/admin", [UserController::class, "store"]);
    Route::post("/userlogin", [UserController::class, "admin"]);
    // Route::put("user_update_image/{id}", [UserController::class, "updateImage"]);
    Route::apiresource("/student", StudentController::class);  
    Route::apiresource("/student_leave_request", StudentLeaveRquestController::class);
    Route::put("user_update_password/{id}", [UserController::class, "updatePassword"]);
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
    Route::put("user_update_password/{id}", [UserController::class, "updatePassword"]);
    Route::put("student_update_password/{id}", [StudentController::class, "updatePassword"]);
    Route::put("student_update_image", [StudentController::class, "updateImage"]);
    Route::get("userlogin", [StudentController::class, "student"]);
});
