<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(RegisterRequest $request){
        $request->validated();
        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),

        ]
        );
        return ApiResponse::getResponse($user ,201,'Registered Successfully');
    }
    public function login(LoginRequest $request){
        $request->validated();
        if(!FacadesAuth::attempt($request->only('email','password'))){
            return ApiResponse::getResponse(null,401,'Invalid Login Information');
        }
        $user=User::where('email',$request->email)->firstOrFail();
        $token=$user->createToken('remember_token')->plainTextToken;
        $user['token']=$token;
        return ApiResponse::getResponse($user,201,'Logged in Successfully');
    }
    public function logout(Request $request){
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
        return ApiResponse::getResponse(null,200,'Logged out successfully');

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
