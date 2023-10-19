<?php

namespace App\Http\Controllers\API\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserFunctionController extends Controller
{
    /**
     * Undocumented function
     * Essa função trás todos os users que são admins
     *
     * @return void
     */
    public function allAdmin() {
        $admins = User::where('role','=','1')->get();
        return response(['admins'=>$admins],200);
    }
    /**
     * Undocumented function
     * Essa função trás todos os users que não são admins
     *
     * @return void
     */
    public function allUser() {
        $admins = User::where('role','=','0')->get();
        return response(['admins'=>$admins],200);
    }

    /**
     * Undocumented function
     * Mostrar os dados de um usuario
     *
     * @param [type] $id
     * @return void
     */
    public function show($id){
        $user = User::findOrFail($id);
        return response(['user'=>$user],200);
    }


    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->save();
            return response(['massege'=>'User updated with sucess'],200);
        }
    }
}
