<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class UserAutenticationController extends Controller
{
    public function login(Request $request){
        if (!auth()->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])) {
            return response(['message' => 'try again'],401);
        }
        $token = auth()->user()->createToken('auth-token')->plainTextToken;
    }
}
