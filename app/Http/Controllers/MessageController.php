<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $messages);
        return response()->json($response, 200);
    }

    public function store(AjoutMessageRequest $request)
    {
        $input = $request->all();
        $new_message = message::create($input);
        $message_save = $new_message->save();
        if($message_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_message);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $message = message::find($id);
        if ($message == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'message introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'message disponible', $message);
        }
        return response()->json($response, 200);
    }
    
    public function destroy($id)
    {
        $message = message::find($id);
        if ($message == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec message Introuvable', null);
            return response()->json($response, 400);
        } else {
            $message_delete = $message->delete();
            if ($message_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $message);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
