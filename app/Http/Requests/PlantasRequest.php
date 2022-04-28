<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantasRequest extends FormRequest
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
            'temperatura_base' => 'required|numeric',
            'grupo_planta_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.string' => 'O nome deve ser uma string',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
            'temperatura_base.required' => 'A temperatura base é obrigatória',
            'temperatura_base.numeric' => 'A temperatura base deve ser um número',
            'grupo_planta_id.required' => 'O grupo de plantas é obrigatório',
            'grupo_planta_id.numeric' => 'O grupo de plantas deve ser um número',
        ];
    }
}
