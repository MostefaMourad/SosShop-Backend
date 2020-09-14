<?php

namespace App\Http\Controllers;

use App\Acheteur;
use App\Commande;
use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Panier;
use App\Produit;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::all();
        foreach ($commandes as $commande) {
            $user = Acheteur::find($commande->panier_id);
            $commande->nom = $user->nom;
            $commande->prenom = $user->prenom;
            $commande->prix = (Produit::find($commande->product_id))->prix ;
        }
        $response = APIHelpers::createAPIResponse(false, 200, '', $commandes);
        return response()->json($response, 200);
    }

    public function store(AjoutCommandeRequest $request)
    {
        $new_commande = new Commande();
        $new_commande->product_id = intval($request->product_id);
        $new_commande->panier_id = intval($request->panier_id);
        $new_commande->quantite = intval($request->quantite);
        $new_commande->cout_livraison = floatval($request->cout_livraison);
        $new_commande->cout_achat = floatval($request->cout_achat);
        $new_commande->cout_total = floatval($request->cout_total);
        $commande_save = $new_commande->save();
        if($commande_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_commande);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $commande = Commande::find($id);
        if ($commande == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'commande introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'commande disponible', $commande);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateCommandeRequest $request,$id){
        $commande= Commande::find($id);
        if($commande!=null){
        {
            if($request->has('quantite')) {
            $commande->quantite = intval($request->quantite);
            }
            if($request->has('cout_livraison')) {
            $commande->cout_livraison = floatval($request->cout_livraison);
            }
            if($request->has('cout_achat')){
                $commande->cout_achat = floatval($request->cout_achat);
            }
            if($request->has('cout_total')){
                $commande->cout_total = floatval($request->cout_total);
            }
            if($request->has('complete')){
                $commande->complete =  boolval($request->complete);
            }    
            $commande_save = $commande->save();
            if ($commande_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $commande);
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
        $commande = Commande::find($id);
        if ($commande == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec commande Introuvable', null);
            return response()->json($response, 400);
        } else {
            $commande_delete = $commande->delete();
            if ($commande_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $commande);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
