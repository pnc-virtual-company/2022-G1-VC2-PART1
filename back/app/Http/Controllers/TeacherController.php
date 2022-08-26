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
    public function show(Request $request, $id)
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
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ],
        ]);
        $teacher = Teacher::findOrFail($id);
        $teacher->firstname = $request->firstname;
        $teacher->lastname = $request->lastname;
        $teacher->email = $request->email;
        $teacher->password = bcrypt($request->password);
        $teacher->gender = $request->gender;
        $teacher->phone = $request->phone;
        $teacher->image = $request->file("image")->hashName();
        $teacher->save();
        return response()->json(['message:' => 'create teacher successfully']);

    }
    
    public function updatePassword(Request $request, $id)
    {$request->validate([
        'password' => [
            'string',
            'min:8',  ],
        ]); 
        $teacher = Teacher::findOrFail($id);
        $teacher->password = bcrypt($request->password);
        $teacher->save();
        return response()->json($teacher);
    }

    public function updateImage(Request $request, $id){
        $request->file('image')->store('public/pictures');
        $teacher = Teacher::findOrFail($id);
        $teacher->image = $request->file("image")->hashName();
        $teacher->save();
        return response()->json($teacher);
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

    public function sigin(Request $request)
    {
        $teacher = Teacher::where('email', $request->email)->first();
        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            return response()->json(["ms" => "Invalid password"], 401);
        }
        $token = $teacher->createToken("mytoken")->plainTextToken;
        $response = [
            'user' => $teacher,
            "token" => $token,
        ];
        return response()->json($response);
    }
    public function teacher()
    {
        return Auth::user();
    }

    public function sigout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(true);
    }
}
