<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:users-api');
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::guard('users')->attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            $user = Auth::guard('users')->user();
            $success['token'] =  $user->createToken('My User')->accessToken;
            $response = APIHelpers::createAPIResponse(false, 200, '', $success);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'Unauthorised', null);
            return response()->json($response, 200);
        }   
    }
}
