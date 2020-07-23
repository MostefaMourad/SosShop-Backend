<?php

namespace App\Http\Controllers;

use App\Acheteur;
use App\Helpers\APIHelpers;
use Illuminate\Http\Request;

class AcheteurController extends Controller
{
    public function index()
    {
        $acheteurs = Acheteur::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $acheteurs);
        return response()->json($response, 200);
    }



    public function show($id)
    {
        $acheteur = Acheteur::find($id);
        if ($acheteur == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'acheteur introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'acheteur disponible', $acheteur);
        }
        return response()->json($response, 200);
    }

    
    public function destroy($id)
    {
        $acheteur = Acheteur::find($id);
        if ($acheteur == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec acheteur Introuvable', null);
            return response()->json($response, 400);
        } else {
            $acheteur_delete = $acheteur->delete();
            if ($acheteur_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $acheteur);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }   
}
