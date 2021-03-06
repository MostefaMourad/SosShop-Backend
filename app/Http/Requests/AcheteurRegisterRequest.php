<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcheteurRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:acheteurs,email',
            'password' => 'required|min:6',
            'nom' => 'nullable|string',
            'prenom' => 'nullable|string',
            'telephone' => 'nullable|string',
        ];
    }
}
