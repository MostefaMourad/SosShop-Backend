<?php

namespace App\Http\Controllers\API;

use App\Acheteur;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcheteurRegisterRequest;
use Illuminate\Http\Request;

class AcheteurRegisterController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:acheteur-api');
    }
    public function register(AcheteurRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $acheteur = Acheteur::create($input);
        $success['token'] =  $acheteur->createToken('My Acheteur')->accessToken;
        $success['name'] =  $acheteur->nom;
        $acheteur_save = $acheteur->save();
        if($acheteur_save){
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['erreur' => null],400);
        }
    }
}
