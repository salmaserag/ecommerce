<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccesTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

            $device_name = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($device_name);   //object token not string

            return Response::json([
                'success' => true,
                'message' => 'Authenticated user',
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }

        return Response::json([
            'success' => false,
            'message' => 'unAuthenticated user',
        ], 401);
    }


    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        //Revoke all tokens -->ex: from all devices
        //$user->tokens()->delete();


        if(null === $token){
            $user->currentAccessToken()->delete();
            return "current token deleted" ;
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);     //return token object

        if (
            $user->id == $personalAccessToken->tokenable_id
            && get_class($user) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
            return "input token deleted" ;
        }

    }
}
