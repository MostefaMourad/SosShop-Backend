<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Marker;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users-api');
    }

    public function show() 
    { 
        $user = Auth::guard('users-api')->user();
        $response = APIHelpers::createAPIResponse(false, 200, 'Utilisateur trouvé', $user);
        return response()->json($response, 200);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::guard('users-api')->user();

        if ($request->has('user_name')) {
            $user->user_name = $request->user_name;
        }
        if ($request->has('age')) {
            $user->age = $request->age;
        }
        if ($request->has('lieu_residence')) {
            $user->lieu_residence = $request->lieu_residence;
        }
        if ($request->has('sexe')) {
            $user->sexe = $request->sexe;
        }
        if ($request->hasFile('profil_image')) {
            $path = Storage::putFile('ProfilesImages', $request->file('profil_image'));
            $user->profil_image = $path;
        } 
        $user_save = $user->save();
        if ($user_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Modification avec succes', $user);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec de modification', null);
            return response()->json($response, 400);
        }
    }

    public function destroy()
    {
        $user = Auth::guard('users-api')->user();
        $user->password = "deleted";
        $user->save();
        $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $user);
        return response()->json($response, 200);  
    }

    public function myMarkers()
    {
        $temp = Auth::guard('users-api')->user();
        $user = Utilisateur::find($temp->id);
        $markers = $user->markers;
        if($markers!=null){
            foreach ($markers as $marker) {
                $rating = Marker::find($marker->id)->rating;
                $marker->rating = $rating;
            }
        }
        $response = APIHelpers::createAPIResponse(false, 200, 'User Markers', $markers);
        return response()->json($response, 200);  
    }
    
    public function resetPassword(ResetPasswordRequest $request){
        $temp = Auth::guard('users-api')->user();
        $user = Utilisateur::find($temp->id);
        if($user->user_name == $request->user_name){
            $user->password = bcrypt($request->password);
            $user_save = $user->save();
            if($user_save){
                $response = APIHelpers::createAPIResponse(false, 200, 'Success', $user);
            }
            else{
                $response = APIHelpers::createAPIResponse(false, 200, 'Echec', null);
            }
            
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 200, 'Echec', null);
        }
        return response()->json($response, 200);
    }
    
    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();
        $response = APIHelpers::createAPIResponse(false, 200, 'You have been succesfully logged out!', null);
        return response()->json($response, 200);
   }
}