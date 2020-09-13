<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $categories);
        return response()->json($response, 200);
    }

    public function store(AjoutCategorieRequest $request)
    {
        $input = $request->all();
        $input['nombre_produits'] = 0;
        $new_categorie = Categorie::create($input);
        $categorie_save = $new_categorie->save();
        if($categorie_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_categorie);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $categorie = Categorie::find($id);
        if ($categorie == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'categorie introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'categorie disponible', $categorie);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateCategorieRequest $request,$id){
        $categorie= Categorie::find($id);
        if($categorie!=null){
        {
            if($request->has('nom')) {
            $categorie->nom = $request->nom;
            }
            $categorie_save = $categorie->save();
            if ($categorie_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $categorie);
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
        $categorie = Categorie::find($id);
        if ($categorie == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec categorie Introuvable', null);
            return response()->json($response, 400);
        } else {
            $categorie_delete = $categorie->delete();
            if ($categorie_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $categorie);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
