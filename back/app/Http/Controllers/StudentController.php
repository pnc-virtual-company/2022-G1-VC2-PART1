<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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
            'username' => [
                'required',
                'string',
                'max:50',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
        ],
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'gender' => ['required',
            'string',
            'max:4',             ],
            'class' => 'required',
            'batch' => 'required|min:4'            
        ]);
        $request->file('image')->store('public/pictures');
        $student = new Student();
        $student->username=$request->username;
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->gender=$request->gender;
        $student->class=$request->class;
        $student->batch=$request->batch;
        $student->image =$request->file("image")->hashName();
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
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
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
            'gender' => ['required',
            'string',
            'max:4',             ],
            'class' => 'required',
            'batch' => ['required',
            'string',
            'min:4',
            ], 
        ]); 

        $student = Student::findOrFail($id);
        $student->username=$request->username;
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->gender=$request->gender;
        $student->class=$request->class;
        $student->batch=$request->batch;
        //$student->image =$request->file("image")->hashName();
        $student->save();
        // $request->file('image')->store('public/pictures');
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

    public function createAccount(Request $request){
        $request->file('image')->store('public/pictures');
        $student = new Student();
        $student->username=$request->username;
        $student->email=$request->email;
        $student->email_verified_at = $request->email_verified_at;
        $student->password=bcrypt($request->password);
        $student->gender=$request->gender;
        $student->class=$request->class;
        $student->batch=$request->batch;
        $student->image =$request->file("image")->hashName();
        $student->save();
        $token = $student->createToken("mytoken")->plainTextToken;
        $response=[
            'user'=>$student,
            "token"=>$token
        ];
        return response()->json([$response]);
    }

    public function userLogin(Request $request){
        $student = Student::where('email', $request->email)->first();
        if (!$student || !Hash::check($request->password, $student->password)) {
           return response()->json(["ms"=>"Invalid password"], 401);
        }
        $token = $student->createToken("mytoken")->plainTextToken;
        $response=[
            'user'=>$student,
            "token"=>$token
        ];
        return response()->json($response);
    }


    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(["ms"=>"logged out"]);
    }
}
