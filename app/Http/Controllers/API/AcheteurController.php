<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\APIHelpers;


class AcheteurController extends Controller
{
    public function profil() 
    { 
        $user = Auth::user(); 
        $response = APIHelpers::createAPIResponse(false, 200, '', $user);
        return response()->json($response, 200);
    }
}
