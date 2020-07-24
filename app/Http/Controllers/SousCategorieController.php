<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutSubCategorieRequest;
use App\Http\Requests\UpdateSubCategorieRequest;
use App\SousCategorie;
use Illuminate\Http\Request;

class SousCategorieController extends Controller
{
    public function index()
    {
        $sub_categories = SousCategorie::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $sub_categories);
        return response()->json($response, 200);
    }

    public function store(AjoutSubCategorieRequest $request)
    {
        $input = $request->all();
        $new_sub_categorie = SousCategorie::create($input);
        $sub_categorie_save = $new_sub_categorie->save();
        if($sub_categorie_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_sub_categorie);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $sub_categorie = SousCategorie::find($id);
        if ($sub_categorie == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'sub_categorie introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'sub_categorie disponible', $sub_categorie);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateSubCategorieRequest $request,$id){
        $sub_categorie= SousCategorie::find($id);
        if($sub_categorie!=null){
        {
            if($request->has('nom')) {
            $sub_categorie->nom = $request->nom;
            }
            $sub_categorie_save = $sub_categorie->save();
            if ($sub_categorie_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $sub_categorie);
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
        $sub_categorie = SousCategorie::find($id);
        if ($sub_categorie == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec sub_categorie Introuvable', null);
            return response()->json($response, 400);
        } else {
            $sub_categorie_delete = $sub_categorie->delete();
            if ($sub_categorie_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $sub_categorie);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
