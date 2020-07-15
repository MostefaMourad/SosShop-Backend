<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Utilisateur;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:users-api');
    }
    public function register(UserRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Utilisateur::create($input);
        $success['token'] =  $user->createToken('My User')->accessToken;
        $response = APIHelpers::createAPIResponse(false, 200, '', $success);
        return response()->json($response, 200);
    }
}
