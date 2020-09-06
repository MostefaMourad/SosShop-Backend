<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutPubliciteRequest;
use App\Publicite;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    public function index()
    {
        $publicites = Publicite::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $publicites);
        return response()->json($response, 200);
    }

    public function store(AjoutPubliciteRequest $request)
    {
        $input = $request->all();
        if($request->hasFile('image')){
            $path = Storage::putFile('ImagesPublicites', $request->image);
            $input['image'] = $path;
        }
        else {
            $input['image'] ="";
        }
        $new_publicite = Publicite::create($input);
        $publicite_save = $new_publicite->save();
        if($publicite_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_publicite);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $publicite = Publicite::find($id);
        if ($publicite == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'publicite introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'publicite disponible', $publicite);
        }
        return response()->json($response, 200);
    }
  
    public function destroy($id)
    {
        $publicite = Publicite::find($id);
        if ($publicite == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec publicite Introuvable', null);
            return response()->json($response, 400);
        } else {
            $publicite_delete = $publicite->delete();
            if ($publicite_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $publicite);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
