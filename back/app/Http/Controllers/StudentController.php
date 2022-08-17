<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Student::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'username' => [
        //         'required',
        //         'string',
        //         'max:50',             
        //         'regex:/[a-z]/',      
        //         'regex:/[A-Z]/',      
        // ],
        //     'email' => 'required|unique:users',
        //     'password' => [
        //         'required',
        //         'string',
        //         'min:10',             // must be at least 10 characters in length
        //         'regex:/[a-z]/',      // must contain at least one lowercase letter
        //         'regex:/[A-Z]/',      // must contain at least one uppercase letter
        //         'regex:/[0-9]/',      // must contain at least one digit
        //         'regex:/[@$!%*#?&]/', // must contain a special character
        //     ],
        //     'gender' => ['required',
        //     'string',
        //     'max:1',             ],
        //     'class' => 'required',
        //     'batch' => 'required|min:4',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $student = new Student();
        $student->username=$request->username;
        $student->email=$request->email;
        $student->password=$request->password;
        $student->gender=$request->gender;
        $student->class=$request->class;
        $student->batch=$request->batch;
        $student->image=$request->file('image')->store('public');
        $student->save();
        return response()->json(['message:'=>'create student successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Student::where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:40',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
        ],
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'gender' => ['required',
            'string',
            'max:1',             ],
            'class' => 'required',
            'batch' => ['required',
            'string',
            'max:4',
        ], 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $student = Student::findOrFail($id);
        $student->username=$request->username;
        $student->email=$request->email;
        $student->password=$request->password;
        $student->gender=$request->gender;
        $student->class=$request->class;
        $student->batch=$request->batch;
        $student->image=$request->file('image')->store('public');
        $student->save();
        return response()->json(['message:'=>'update student successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Student::destroy($id);
    }
}
