<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
            'perfil' => 'required|max:255', 
            'nivel_acesso' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'perfil.required' => 'O campo perfil é obrigatório.',
            'perfil.max' => 'O campo perfil deve ter no máximo :max caracteres.',
            'nivel_acesso.required' => 'O campo nível de acesso é obrigatório.',
            'nivel_acesso.numeric' => 'O campo nível de acesso deve ser numérico.',
        ];
    }
}
