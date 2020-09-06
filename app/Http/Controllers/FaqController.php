<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $faqs);
        return response()->json($response, 200);
    }

    public function store(AjoutFaqRequest $request)
    {
        $input = $request->all();
        $new_faq = Faq::create($input);
        $faq_save = $new_faq->save();
        if($faq_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_faq);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $faq = Faq::find($id);
        if ($faq == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'faq introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'faq disponible', $faq);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateFaqRequest $request,$id){
        $faq= Faq::find($id);
        if($faq!=null){
        {
            if($request->has('question')) {
            $faq->question = $request->question;
            }
            if($request->has('reponse')) {
            $faq->reponse = $request->reponse;
            }
            $faq_save = $faq->save();
            if ($faq_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $faq);
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
        $faq = Faq::find($id);
        if ($faq == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec faq Introuvable', null);
            return response()->json($response, 400);
        } else {
            $faq_delete = $faq->delete();
            if ($faq_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $faq);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
