<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function register(Request $request){
        try {
            DB::beginTransaction();
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                if($user->save())
                    DB::commit();
                    return response([
                        'user' => $user,
                        'message' => 'User Created with sucess'
                    ], 200);
        } catch (Exception $e) {
          DB::rollBack();
          return response(
            [
                'message' => 'User Created with sucess'
            ], 500
          );
        }
        
    }
}
