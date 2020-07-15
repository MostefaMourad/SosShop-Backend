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
            'categorie' => 'required|string',
            'sous_categorie' => 'required|string',
            'marque' => 'required|string',
            'quantite' => 'required|integer',
            'couleur' => 'required|string',
            'longueur' => 'required|numeric',
            'largeur' => 'required|numeric',
            'hauteur' => 'required|numeric',
            'poids' => 'required|numeric',
            'espace_vendeur_id' => 'integer|required|exists:espace_vendeurs,id',
            'image.*' => 'image|dimensions:min_width=200,min_height=100',
            'image' => 'nullable|array'
        ];
    }
}
