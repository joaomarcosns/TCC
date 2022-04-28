<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPodasRequest extends FormRequest
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
            'data_poda' => 'required|date',
            'setor_id' => 'required|exists:setor,id',
        ];
    }

    public function messages()
    {
        return [
            'data_poda.required' => 'O campo data da poda é obrigatório',
            'data_poda.date' => 'O campo data da poda deve ser uma data válida',
            'setor_id.required' => 'O campo setor é obrigatório',
            'setor_id.exists' => 'O campo setor deve ser uma setor válida',
        ];
    }
}
