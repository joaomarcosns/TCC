<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatosAtualizarRequest extends FormRequest
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
            "propriedade_id" => "required|numeric",
        ];
    }

    public function messages()
    {
        return [
            "telefone.required" => "O campo telefone é obrigatório",
            "telefone.min" => "O campo telefone deve ter no mínimo :min caracteres",
            "telefone.max" => "O campo telefone deve ter no máximo :max caracteres",
            "propriedade_id.required" => "O campo propriedade é obrigatório",
            "propriedade_id.numeric" => "O campo propriedade deve ser um número inteiro",
        ];
    }
}
