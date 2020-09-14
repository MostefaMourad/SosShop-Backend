<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $services);
        return response()->json($response, 200);
    }

    public function store(AjoutServiceRequest $request)
    {
        $input = $request->all();
        if($request->hasFile('image')){
            $path = Storage::putFile('ImagesServices', $request->image);
            $input['image'] = $path;
        }
        else {
            $input['image'] ="";
        }
        $new_service = Service::create($input);
        $service_save = $new_service->save();
        if($service_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_service);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $service = Service::find($id);
        if ($service == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'service introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'service disponible', $service);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateServiceRequest $request,$id){
        $service= Service::find($id);
        if($service!=null){
        {
            if($request->has('partenaire')) {
            $service->partenaire = $request->partenaire;
            }
            if($request->has('numero')) {
            $service->numero = $request->numero;
            }
            if($request->has('titre')) {
            $service->titre = $request->titre;
            }
            if($request->has('description')){
                $service->description = $request->description;
            }
            if($request->has('prix')){
                $service->prix = $request->prix;
            }
            if($request->hasFile('image')){
                $path = Storage::putFile('ImagesServices', $request->image);
                $service->image = $path;
            }
            $service_save = $service->save();
            if ($service_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $service);
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
        $service = Service::find($id);
        if ($service == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec service Introuvable', null);
            return response()->json($response, 400);
        } else {
            $service_delete = $service->delete();
            if ($service_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $service);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
