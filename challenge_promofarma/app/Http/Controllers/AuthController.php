<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    /**
     * Controller where an user logs in platform
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email'       => 'required|string|email',
                'password'    => 'required|string',
                'remember_me' => 'boolean',
            ]);
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized'], 500);
            }
            $user = $request->user();
            if(!$user->userAvailable()){
                return response()->json([
                    'message' => 'Unauthorized'], 500);
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
            ], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

    /**
     * Controller where an user logs out in platform
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try{
            $request->user()->token()->revoke();
            return response()->json(['message' =>
                'Successfully logged out'], 200);
        }
        catch (\Exception $e){
            return response()->json(['message' =>
            'We found the following error: '.$e->getMessage()], 500);
        }
    }


}
