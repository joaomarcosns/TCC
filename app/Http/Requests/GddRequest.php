<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GddRequest extends FormRequest
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
            'diaInicial' => 'required|date',
            'diaFinal' => 'required|date',
            'id_planta' => 'required|integer|exists:plantas,id',
        ];
    }

    public function messages()
    {
        return [
            'diaInicial.required' => 'O campo dia inicial é obrigatório',
            'diaInicial.date' => 'O campo dia inicial deve ser uma data válida',
            'diaFinal.date' => 'O campo dia final deve ser uma data válida',
            'diaFinal.required' => 'O campo dia final é obrigatório',
            'id_planta.required' => 'O campo planta é obrigatório',
            'id_planta.integer' => 'O campo planta deve ser um número inteiro',
            'id_planta.exists' => 'O campo planta deve ser um número inteiro válido',
        ];
    }
}
