<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendeurLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendeurLoginController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:vendeur-api');
    }

    public function login(VendeurLoginRequest $request)
    {
        if (Auth::guard('vendeur')->attempt(['email' => $request->email, 'password' => $request->password,'inscription_complete'=>true])) {
            $user = Auth::guard('vendeur')->user();
            $success['token'] =  $user->createToken('My Vendeur')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
