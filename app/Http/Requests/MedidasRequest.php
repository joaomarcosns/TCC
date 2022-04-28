<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedidasRequest extends FormRequest
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
            "altura_total" => "numeric",
            "largura_total" => "required|numeric",
            "comprimento_total" => "required|numeric",
            "hectares" => "required|numeric",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "hemisferio" => "required|numeric",
        ];
    }

    public function messages()
    {
        return [
            "altura_total.numeric" => "O campo Altura Total deve ser um número.",
            "largura_total.required" => "O campo Largura Total é obrigatório.",
            "largura_total.numeric" => "O campo Largura Total deve ser um número.",
            "comprimento_total.required" => "O campo Comprimento Total é obrigatório.",
            "comprimento_total.numeric" => "O campo Comprimento Total deve ser um número.",
            "hectares.required" => "O campo Hectares é obrigatório.",
            "hectares.numeric" => "O campo Hectares deve ser um número.",
            "latitude.required" => "O campo Latitude é obrigatório.",
            "latitude.numeric" => "O campo Latitude deve ser um número.",
            "longitude.required" => "O campo Longitude é obrigatório.",
            "longitude.numeric" => "O campo Longitude deve ser um número.",
            "hemisferio.required" => "O campo Hemisfério é obrigatório.",
            "hemisferio.numeric" => "O campo Hemisfério deve ser um número.",
        ];
    }
}
