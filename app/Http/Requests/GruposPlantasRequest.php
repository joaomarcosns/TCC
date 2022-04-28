<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GruposPlantasRequest extends FormRequest
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
            'nome' => 'required|string|max:255|min:3',
            'descricao' => 'required|string|max:255|min:3',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'nome.max' => 'O campo deve ter no :max caracteres',
            'nome.min' => 'O campo deve ter no :min caracteres',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.string' => 'O campo descrição deve ser uma string',
            'descricao.max' => 'O campo deve ter no :max caracteres',
            'descricao.min' => 'O campo deve ter no :min caracteres',
        ];
    }
}
