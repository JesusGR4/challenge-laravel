<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Controller where an user can sign up in platform
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request){

        $request->validate([ 'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User(['name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'status'   => User::active]);

        $user->save();

        return response()->json([
            'message' => 'Usuario creado correctamente'], 200);
    }


    /**
     * Controller where an user updates his info
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        $request->validate([
            'email'       => 'string|email',
            'password'    => 'string',
        ]);
        $user = Auth::user();

        $user->update($request->all());
        return response()->json(['message' =>
            'Successfully user update']);
    }

    public function delete(Request $request){
        $user = Auth::user();
        $user->update(['status' => User::disabled]);

        return response()->json(['message' =>
            'Usuario correctamente borrado']);
    }



}
