<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'message' => 'Invalide Email/Password',
                'status_code' => 401,
            ], 401);
        }

        $user = $request->user();
        if(strtolower($user->role->name) === 'administrator') {
            $tokenData = $user->createToken('Personal Access Token', ['do_anything']);
        } else {
            $tokenData = $user->createToken('Personal Access Token', ['can_create']);
        }

        $token = $tokenData->token;

        if($request->remeber_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        if($token->save()) {
            return response()->json([
                'user' => $user,
                "access_token" => $tokenData->accessToken,
                "token_type" => "Bearer",
                "token_scope" => $tokenData->token->scopes[0],
                "expires_at" => Carbon::parse($tokenData->token->expires_at)->toDateTimeLocalString(),
                'status_code' => 200
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Some error occurred',
                'status_code' => 500,
            ], 500);
        }

    }

    public function logout(Request $request) {

        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Logout Successfully',
            'status_code' => 200,
        ], 200);
    }
}
