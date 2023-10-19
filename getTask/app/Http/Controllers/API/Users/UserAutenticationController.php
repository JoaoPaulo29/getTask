<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserAutenticationRequest;
use Illuminate\Support\Facades\Request;

class UserAutenticationController extends Controller
{
 
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

    public function logout(Request $request){ 
        $request::user()->tokens()->delete();
        return  response( ['message' =>'The user is logout'],200);
    }
}
