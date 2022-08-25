<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Teacher::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'gender' => [
                'required',
                'string',
                'max:4',
            ],

        ]);
        $request->file('image')->store('public/pictures');
        $teacher = new Teacher();
        $teacher->firstname = $request->firstname;
        $teacher->lastname = $request->lastname;
        $teacher->email = $request->email;
        $teacher->password = bcrypt("12345678");
        $teacher->gender = $request->gender;
        $teacher->phone = $request->phone;
        $teacher->role = "teacher";
        $teacher->image = $request->file("image")->hashName();
        $teacher->save();
        return response()->json(['message:' => 'create teacher successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $id)
    {
        return Teacher::where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                'regex:/[a-z]',
                'regex:/[A-Z]',
            ],
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'gender' => [
                'required',
                'string',
                'max:4',
            ],
            'class' => 'required',
            'batch' => [
                'required',
                'string',
                'min:4',
            ],
        ]);
        $teacher = Teacher::findOrFail($id);
        // $teacher = new Teacher();
        $teacher->firstname = $request->firstname;
        $teacher->lastname = $request->lastname;
        $teacher->email = $request->email;
        $teacher->password = bcrypt($request->password);
        $teacher->gender = $request->gender;
        $teacher->phone = $request->phone;
        $teacher->role = "teacher";
        $teacher->image = $request->file("image")->hashName();
        $teacher->save();
        return response()->json(['message:' => 'create teacher successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Teacher::destroy($id);
    }
}
