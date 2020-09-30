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
        $products = Produit::orderBy(DB::raw('RAND()'))->take(30)->get();
        $chunks = $products->chunk(10,true);
        $data['produitsf'] = array_values(($chunks[0])->toArray());
        $data['produitss'] = array_values(($chunks[1])->toArray());
        $data['produitst'] = array_values(($chunks[2])->toArray());
        $data['publicites'] = Publicite::all();
        $data['vendeurs'] = Vendeur::orderBy(DB::raw('RAND()'))->take(12)->get();
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
