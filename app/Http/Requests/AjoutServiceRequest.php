<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutServiceRequest extends FormRequest
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
            'titre' => 'string|required',
            'description' => 'string|required',
            'partenaire' => 'required|string',
            'numero' => 'required|string',
            'prix' => 'required|numeric',
            'image' => 'nullable|image',
        ];
    }
}
