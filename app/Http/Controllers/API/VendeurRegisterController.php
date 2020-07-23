<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendeurRegisterRequest;
use App\Vendeur;
use Illuminate\Http\Request;

class VendeurRegisterController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('guest:vendeur-api');
    }
    public function register(VendeurRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $vendeur = Vendeur::create($input);
        $success['token'] =  $vendeur->createToken('My Vendeur')->accessToken;
        $success['name'] =  $vendeur->nom;
        $vendeur_save = $vendeur->save();
        if($vendeur_save){
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['erreur' => null],400);
        }
    }
}
