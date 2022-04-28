<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorRequest extends FormRequest
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
            'identificador' => 'required|max:255',
            'area_id' => 'required|exists:area,id',
        ];
    }

    public function messages()
    {
        return [
            'identificador.required' => 'O campo identificador é obrigatório',
            'identificador.max' => 'O campo identificador deve ter no máximo :max caracteres',
            'area_id.required' => 'O campo área é obrigatório',
            'area_id.exists' => 'O campo área deve ser válido',
        ];
    }
}
