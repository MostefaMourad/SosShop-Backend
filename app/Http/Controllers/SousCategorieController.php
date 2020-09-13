<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutSubCategorieRequest;
use App\Http\Requests\UpdateSubCategorieRequest;
use App\SousCategorie;
use Illuminate\Support\Facades\Storage;

class SousCategorieController extends Controller
{
    public function index()
    {
        $sub_categories = SousCategorie::all();
        foreach ($sub_categories as $subcat) {
            $subcat->categorie = (Categorie::find($subcat->categorie_id))->nom;
        }
        $response = APIHelpers::createAPIResponse(false, 200, '', $sub_categories);
        return response()->json($response, 200);
    }

    public function store(AjoutSubCategorieRequest $request)
    {
        $input = $request->all();
        $input['nombre_produits'] = 0 ;
        if($request->hasFile('image')){
            $path = Storage::putFile('ImagesServices', $request->image);
            $input['image'] = $path;
        }
        else {
            $input['image'] ="";
        }
        $new_sub_categorie = SousCategorie::create($input);
        $sub_categorie_save = $new_sub_categorie->save();
        $new_sub_categorie->categorie = (Categorie::find( $new_sub_categorie->categorie_id))->nom;
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
