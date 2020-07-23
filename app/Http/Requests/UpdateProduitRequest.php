<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduitRequest extends FormRequest
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
            'titre' => 'nullable|string',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric',
            'prix_promotionnel' => 'nullable|numeric|lte:prix',
            'categorie' => 'nullable|integer',
            'sub_categorie' => 'nullable|integer',
            'marque' => 'nullable|string',
            'quantite' => 'nullable|integer',
            'couleur' => 'nullable|string',
            'longueur' => 'nullable|numeric',
            'largeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'poids' => 'nullable|numeric',
        ];
    }
}
