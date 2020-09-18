<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Produit;
use App\Publicite;
use App\SousCategorie;
use App\Vendeur;
use Illuminate\Support\Facades\DB;

class AccueilController extends Controller
{
    public function home()
    {
        $data = [];
        $data['produits'] = Produit::orderBy(DB::raw('RAND()'))->take(30)->get();
        $data['publicites'] = Publicite::all();
        $data['vendeurs'] = Vendeur::orderBy(DB::raw('RAND()'))->take(10)->get();
        $sub_cat = SousCategorie::orderBy(DB::raw('RAND()'))->take(4)->get();
        foreach ($sub_cat as $item) {
            $prods = DB::table('produits')->where('sous_categorie_id',$item->id)->take(5)->get();
            $item->produits = $prods ;
        }
        $data['sub_categories'] = $sub_cat ;
        $response = APIHelpers::createAPIResponse(false, 200, '', $data);
        return response()->json($response, 200);
    }
}
