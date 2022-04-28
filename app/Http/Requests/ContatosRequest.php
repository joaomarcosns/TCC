<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatosRequest extends FormRequest
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
            "telefone" => "required|min:10|max:15",
            "email" => "required|email|unique:contatos",
            "propriedade_id" => "required|numeric",
        ];
    }

    public function messages()
    {
        return [
            "telefone.required" => "O campo telefone é obrigatório",
            "telefone.min" => "O campo telefone deve ter no mínimo :min caracteres",
            "telefone.max" => "O campo telefone deve ter no máximo :max caracteres",
            "email.required" => "O campo email é obrigatório",
            "email.email" => "O campo email deve ser um email válido",
            "email.unique" => "O campo email deve ser único",
            "propriedade_id.required" => "O campo propriedade é obrigatório",
            "propriedade_id.numeric" => "O campo propriedade deve ser um número inteiro",
        ];
    }
}
