<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserAutenticationRequest; 

class UserAutenticationController extends Controller
{

    public function __construct() { 
        $this->middleware('auth:sanctum')->only('logout');
    }

    public function login(UserAutenticationRequest $request){
       
         
        $credenciais = $request->only('password','email');
        if (!auth()->attempt($credenciais)) {
            return response(['message' => 'try again'],401);
        }
        $token =  $request->user()->createToken('auth-token')->plainTextToken;
        return response([
            'token' => $token,
            'user' => auth()->user(),
        ],200);
    }

    public function logout(UserAutenticationRequest $request){
        $request->user()->currentAccessToken()->delete();
        return $this->responseSeccess([],'Logout feito',200);
    }
}
