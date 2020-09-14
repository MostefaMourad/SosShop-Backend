<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titre' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'prix_promotionnel' => 'required|numeric|lte:prix',
            'categorie_id' => 'required|integer|exists:categories,id',
            'sous_categorie_id' => 'required|integer|exists:sous_categories,id',
            'marque' => 'required|string',
            'quantite' => 'required|integer',
            'couleur' => 'required|string',
            'longueur' => 'required|numeric',
            'largeur' => 'required|numeric',
            'hauteur' => 'required|numeric',
            'poids' => 'required|numeric',
            'espace_vendeur_id' => 'integer|required|exists:espace_vendeurs,id',
            'image' => 'required|array',
            'image.*' => 'image|dimensions:min_width=200,min_height=100',
        ];
    }
}
