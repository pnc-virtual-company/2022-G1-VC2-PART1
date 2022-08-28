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
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users|email|regex:/(.*)@student.passerellesnumeriques.org\.com/i',
            'class' => 'required',
            'batch' => 'required|min:4',
            'user_id' => 'required|',
        ]);
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
        $student->user_id = $request->user_id;
        $student->image = $request->file("image");
        $student->save();
        return response()->json($student);
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
            'min:8',  ],
        ]); 
        $student = Student::findOrFail($id);
        $student->password = bcrypt($request->password);
        $student->save();
        return response()->json(['message:' => 'update student successfully']);
    }

    public function updateImage(Request $request, $id){
        $request->file('image')->store('public/pictures');
        $student = Student::findOrFail($id);
        $student->image = $request->file("image")->hashName();
        $student->save();
        return response()->json(['message:' => 'update student successfully']);
    }

    public function update(Request $request, $id){
        $student = Student::findOrFail($id);
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->class = $request->class;
        $student->batch = $request->batch;
        $student->save();
        return response()->json($student);
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
  

    public function sigin(Request $request)
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
    public function student()
    {
        return Auth::user();
    }

    public function sigout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(true);
    }

    public function updateProfile(Request $request, Student $student)
    {
        $student->image = $request->image;
        $student->save();
        return response()->json(["ms" => "update successfully"]);
    }
}
