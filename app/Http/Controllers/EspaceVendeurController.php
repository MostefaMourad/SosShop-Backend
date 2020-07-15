<?php

namespace App\Http\Controllers;

use App\EspaceVendeur;
use App\Helpers\APIHelpers;
use Illuminate\Http\Request;

class EspaceVendeurController extends Controller
{
    public function index()
    {
        $espaces = EspaceVendeur::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $espaces);
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $espace = EspaceVendeur::find($id);
        if ($espace == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'espace introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'espace disponible', $espace);
        }
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $espace = EspaceVendeur::find($id);
        if ($espace == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec espace Introuvable', null);
            return response()->json($response, 400);
        } else {
            $espace_delete = $espace->delete();
            if ($espace_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $espace);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
