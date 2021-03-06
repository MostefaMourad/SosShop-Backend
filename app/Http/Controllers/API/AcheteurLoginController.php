<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcheteurLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcheteurLoginController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:acheteur-api');
    }

    public function login(AcheteurLoginRequest $request)
    {
        if (Auth::guard('acheteur')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('acheteur')->user();
            $success['token'] =  $user->createToken('My Acheteur')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();
        $response = APIHelpers::createAPIResponse(false, 200, 'You have been succesfully logged out!', null);
        return response()->json($response, 200);
   }
}
