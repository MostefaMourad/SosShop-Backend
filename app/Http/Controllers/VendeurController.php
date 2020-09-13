<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function index()
    {
        $vendeurs = Vendeur::where('id', '!=',1)->get();
        $response = APIHelpers::createAPIResponse(false, 200, '', $vendeurs);
        return response()->json($response, 200);
    }



    public function show($id)
    {
        $vendeur = Vendeur::find($id);
        if ($vendeur == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'vendeur introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'vendeur disponible', $vendeur);
        }
        return response()->json($response, 200);
    }

    
    public function destroy($id)
    {
        $vendeur = Vendeur::find($id);
        if ($vendeur == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec vendeur Introuvable', null);
            return response()->json($response, 400);
        } else {
            $vendeur_delete = $vendeur->delete();
            if ($vendeur_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $vendeur);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }   
}
