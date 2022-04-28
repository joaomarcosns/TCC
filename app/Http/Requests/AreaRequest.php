<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
            'nome' => 'required|max:255|min:3|unique:area,nome,'.$this->id,
            'descricao' => 'required|max:255|min:3',
            'propriedade_id' => 'required|exists:propriedade,id',
        ];
    }
    
    public function messages()
    {
       return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'nome.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'nome.unique' => 'O nome informado já está cadastrado.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'O campo descrição deve ter no máximo :max caracteres.',
            'descricao.min' => 'O campo descrição deve ter no mínimo :min caracteres.',
            'propriedade_id.required' => 'O campo propriedade é obrigatório.',
            'propriedade_id.exists' => 'A propriedade informada não existe.',
       ];
    }
}
