<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
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
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users|email|regex:/(.*)@passerellesnumeriques.org',
        ]);
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt("12345678");
        $user->role = $request->role;
        $user->image = $request->file("image")->hashName();
        $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return User::where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $user = User::findOrFail($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $response = [
            'user' => $user,
        ];
        return response()->json($response);
    }

    public function updateImage(Request $request, $id){
        $request->validate([
            'image'=>'image|mimes:jpg,png,jpeg,gif|max:19999',
        ]);
        $request->file('image')->store('public/pictures');
        $user = User::findOrFail($id);
        $user->image = $request->file("image")->hashName();
        $user->save();
        $token = $user->createToken("mytoken")->plainTextToken;
        $response = [
            'user' => $user,
            "token" => $token,
        ];
        return response()->json($response);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
        'password' => [
            'string',
            'min:8',  ],
        ]); 
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $token = $user->createToken("mytoken")->plainTextToken;
        $response = [
            'user' => $user,
            "token" => $token,
        ];
        $user->save();
        return response()->json(['message:' => 'update user successfully', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return User::where('id', $id)->delete();
    }

    // public function getUserById(Request $request,$user_id){
    //     return User::where('user_id',$user_id)->get();
    // }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            // 'email' => 'required|email|regex:/(.*)passerellesnumeriques.org/i',

        ]);
        $request->file('image')->store('public/pictures');
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt("12345678");
        $user->role = $request->role;
        $user->image = $request->file("image")->hashName();
        $user->save();
        return response()->json($user);
    }
    public function sigin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["ms" => "Invalid password"], 401);
        }
        $token = $user->createToken("mytoken")->plainTextToken;
        $response = [
            'user' => $user,
            "token" => $token,
        ];
        return response()->json($response);
    }
    public function admin()
    {
        return Auth::user();
    }

    public function sigout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(true);
    }

}
