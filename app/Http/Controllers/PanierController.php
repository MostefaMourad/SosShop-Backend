<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Panier;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index()
    {
        $paniers = Panier::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $paniers);
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $panier = Panier::find($id);
        if ($panier == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'Panier introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'Panier disponible', $panier);
        }
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $panier = Panier::find($id);
        if ($panier == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec panier Introuvable', null);
            return response()->json($response, 400);
        } else {
            $panier_delete = $panier->delete();
            if ($panier_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $panier);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
