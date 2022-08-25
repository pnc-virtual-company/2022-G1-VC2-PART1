<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
<<<<<<< HEAD
        

=======

        $request->validate([
            'email' => 'required|unique:users',
            'gender' => ['required',
                'string',
                'max:4'],
            'class' => 'required',
            'batch' => 'required|min:4',
        ]);
>>>>>>> 01973c4cc049b3a0cc31788545bc90d48ec410bb
        $request->file('image')->store('public/pictures');
        $student = new Student();
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
        $student->password = bcrypt("12345678");
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->class = $request->class;
        $student->batch = $request->batch;
        $student->role = "student";
        $student->image = $request->file("image")->hashName();
        $student->save();
        return response()->json(['message:' => 'create student successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {$request->validate([
        'password' => [
            'string',
<<<<<<< HEAD
            'max:4',             ],
            'class' => 'required',
            'batch' => ['required',
            'string',
            'min:4',

            ], 
        ]); 

        $student = Student::findOrFail($id);
        $student->firstname=$request->firstname;
        $student->lastname=$request->lastname;
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->gender=$request->gender;
        $student->phone=$request->phone;
        $student->class=$request->class;
        $student->batch=$request->batch;
        $student->role="student";
        //$student->image =$request->file("image")->hashName();
=======
            'min:8', // must be at least 8 characters in length
            'regex:/[a-z]/', // must contain at least one lowercase letter
            'regex:/[A-Z]/', // must contain at least one uppercase letter
            'regex:/[0-9]/', // must contain at least one number
            'regex:/[@$!%*#?&]/', // must contain a special character
        ],
    ]);
        $student = Student::findOrFail($id);
        $student->password = bcrypt($request->password);
>>>>>>> 01973c4cc049b3a0cc31788545bc90d48ec410bb
        $student->save();
        return response()->json(['message:' => 'update student successfully']);
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
    public function createAccount(Request $request)
    {
        $request->file('image')->store('public/pictures');
        $student = new Student();
<<<<<<< HEAD
        $student->firstname=$request->firstname;
        $student->lastname=$request->lastname;
        $student->email=$request->email;
        $student->phone=$request->phone;
=======
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
>>>>>>> 01973c4cc049b3a0cc31788545bc90d48ec410bb
        $student->email_verified_at = $request->email_verified_at;
        $student->password = bcrypt($request->password);
        $student->gender = $request->gender;
        $student->class = $request->class;
        $student->batch = $request->batch;
        $student->role = "student";
        $student->image = $request->file("image")->hashName();
        $student->save();
        $token = $student->createToken("mytoken")->plainTextToken;
        $response = [
            'user' => $student,
            "token" => $token,
        ];
        return response()->json([$response]);
    }

    public function userLogin(Request $request)
    {
        $student = Student::where('email', $request->email)->first();
        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(["ms" => "Invalid password"], 401);
        }
        $token = $student->createToken("mytoken")->plainTextToken;
        $response = [
            'user' => $student,
            "token" => $token,
        ];
        return response()->json($response);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(["ms" => "logged out"]);
    }
}
