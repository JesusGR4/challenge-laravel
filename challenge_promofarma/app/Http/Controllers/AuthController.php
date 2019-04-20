<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    /**
     * Controller where an user can sign up in platform
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request){

        $request->validate([ 'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User(['name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'status'   => true]);

        $user->save();

        return response()->json([
            'message' => 'Usuario creado correctamente'], 200);
    }

    /**
     * Controller where an user logs in platform
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        if(!$user->userAvailable()){
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
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
        $attrs = [];
        if($request->has('email')) $attrs['email'] = $request->input('email');
        if($request->has('password')) $attrs['password'] = bcrypt($request->input('password'));
        if($request->has('name')) $attrs['name'] = $request->input('name');
        if(empty($attrs)){
            return response()->json([
                'message' => 'Nothing to change'], 401);
        }
        $user->update($attrs);
        return response()->json(['message' =>
            'Usuario correctamente actualizado']);
    }

    public function delete(Request $request){
        $user = Auth::user();
        $user->update(['status' => 0]);

        return response()->json(['message' =>
            'Usuario correctamente borrado']);
    }

    /**
     * Controller where an user logs out in platform
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }


}
