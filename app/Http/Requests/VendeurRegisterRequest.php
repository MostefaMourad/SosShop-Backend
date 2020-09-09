<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendeurRegisterRequest extends FormRequest
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
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'telephone_sup' => 'nullable|string',
            'nom_boutique' => 'required|string',            
            'adresse' => 'required|string',            
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:vendeurs,email',
            'password' => 'required|min:6',
        ];
    }
}
