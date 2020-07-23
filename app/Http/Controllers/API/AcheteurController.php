<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcheteurController extends Controller
{
    public function profil() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], 200); 
    }
}
