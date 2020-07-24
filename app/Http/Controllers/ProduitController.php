<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Produit;
use Illuminate\Support\Facades\Storage; 

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $produits);
        return response()->json($response, 200);
    }

    public function store(AjoutProduitRequest $request)
    {
        $new_produit = new Produit();
        $new_produit->titre = $request->titre;
        $new_produit->description = $request->description;
        $new_produit->prix = floatval($request->prix);
        $new_produit->prix_promotionnel = floatval($request->prix_promotionnel);
        $new_produit->categorie = intval($request->categorie);
        $new_produit->sous_categorie = intval($request->sous_categorie);
        $new_produit->marque = $request->marque;
        $new_produit->quantite = intval($request->quantite);
        $new_produit->couleur = $request->couleur;
        $new_produit->longueur = floatval($request->longueur);
        $new_produit->largeur =  floatval($request->largeur);
        $new_produit->hauteur = floatval($request->hauteur);
        $new_produit->poids = floatval($request->poids);
        $new_produit->espace_vendeur_id = intval($request->espace_vendeur_id);
        $images = [];
        $i=0;
        if($request->image!=null){
            foreach ($request->image as $image) {
               $path = Storage::putFile('ImagesProduits', $image);
               $images[$i] = $path;
               $i+=1;
            }
        }
        $new_produit->images = $images;
        $produit_save = $new_produit->save();
        if($produit_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_produit);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $produit = Produit::find($id);
        if ($produit == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'produit introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'produit disponible', $produit);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateProduitRequest $request,$id){
        $produit= Produit::find($id);
        if($produit!=null){
        {
            if($request->has('description')) {
            $produit->description = $request->description;
            }
            if($request->has('titre')) {
            $produit->titre = $request->titre;
            }
            if($request->has('prix')){
                $produit->prix = $request->prix;
            }
            if($request->has('prix_promotionnel')){
                $produit->prix_promotionnel = $request->prix_promotionnel;
            }
            if($request->has('marque')){
                $produit->marque = $request->marque;
            }
            if($request->has('quantite')){
                $produit->quantite = $request->quantite;
            }
            if($request->has('couleur')) {
            $produit->couleur = $request->couleur;
            }
            if($request->has('longueur')) {
            $produit->longueur = $request->longueur;
            }
            if($request->has('largeur')){
                $produit->largeur = $request->largeur;
            }
            if($request->has('hauteur')){
                $produit->hauteur = $request->hauteur;
            }
            if($request->has('poids')){
                $produit->poids = $request->poids;
            }
            $produit_save = $produit->save();
            if ($produit_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $produit);
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
        $produit = Produit::find($id);
        if ($produit == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec produit Introuvable', null);
            return response()->json($response, 400);
        } else {
            $produit_delete = $produit->delete();
            if ($produit_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $produit);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
