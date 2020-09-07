<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutLivraisonRequest;
use App\Http\Requests\UpdateLivraisonRequest;
use App\Livraison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivraisonController extends Controller
{
    public function index()
    {
        $livraisons = Livraison::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $livraisons);
        return response()->json($response, 200);
    }

    public function store(AjoutLivraisonRequest $request)
    {
        $input = $request->all();
        $input['etat'] = 'en attente de confirmation';
        $user = Auth::user();
        $input['acheteur_id'] = $user->id;
        $new_livraison = Livraison::create($input);
        $livraison_save = $new_livraison->save();
        if($livraison_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_livraison);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $livraison = Livraison::find($id);
        if ($livraison == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'livraison introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'livraison disponible', $livraison);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateLivraisonRequest $request,$id){
        $livraison= Livraison::find($id);
        if($livraison!=null){
        {
            if($request->has('etat')){
                $livraison->etat = $request->etat;
            }
            $livraison_save = $livraison->save();
            if ($livraison_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $livraison);
                return response()->json($response, 200);
            } 
            else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
        }else{
            $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
            return response()->json($response, 400); 
        }
    }
    
    public function destroy($id)
    {
        $livraison = Livraison::find($id);
        if ($livraison == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec livraison Introuvable', null);
            return response()->json($response, 400);
        } else {
            $livraison_delete = $livraison->delete();
            if ($livraison_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $livraison);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
