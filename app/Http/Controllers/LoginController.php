<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ResponseTrait;

    public function login(Request $request)
    {
        // check the request if the use email and password is valid
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->responseError([], 'No user found');
        }

        // check the password
        if (Hash::check($request->password, $user->password)) {
            $tokenCreated = $user->createToken('authToken');
            $data = [
                'user' => $user,
                'access_token' => $tokenCreated->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenCreated->token->expires_at)->toDateTimeString()
            ];

            return $this->responseSuccess($data, 'Logged in successfully');
        }
    }
}
