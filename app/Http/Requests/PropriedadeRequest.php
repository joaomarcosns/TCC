<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropriedadeRequest extends FormRequest
{
    public function rules()
    {
        return [
            "nome_proprietario" => "required|string|max:255|min:3",
            "nome_propriedade" => "required|string|max:255|min:3",
            "rua" => "required|string|max:100|min:3",
            "numero" => "required|string|max:10|min:3",
            "bairro" => "required|string|max:100|min:3",
            "cidade" => "required|string|max:100|min:3",
            "cep" => "required|string|max:9",
            "estado" => "required|string|max:2",
            "medida_id" => "required|exists:medidas,id",
        ];
    }

    public function messages()
    {
        return [
            "nome_proprietario.required" => "O campo nome do proprietário é obrigatório.",
            "nome_proprietario.string" => "O campo nome do proprietário deve ser uma string.",
            "nome_proprietario.max" => "O campo nome do proprietário deve ter no máximo :max caracteres.",
            "nome_proprietario.min" => "O campo nome do proprietário deve ter no mínimo :min caracteres.",
            "nome_propriedade.required" => "O campo nome da propriedade é obrigatório.",
            "nome_propriedade.string" => "O campo nome da propriedade deve ser uma string.",
            "nome_propriedade.max" => "O campo nome da propriedade deve ter no máximo :max caracteres.",
            "nome_propriedade.min" => "O campo nome da propriedade deve ter no mínimo :min caracteres.",
            "rua.required" => "O campo rua é obrigatório.",
            "rua.string" => "O campo rua deve ser uma string.",
            "rua.max" => "O campo rua deve ter no máximo :max caracteres.",
            "rua.min" => "O campo rua deve ter no mínimo :min caracteres.",
            "numero.required" => "O campo número é obrigatório.",
            "numero.string" => "O campo número deve ser uma string.",
            "numero.max" => "O campo número deve ter no máximo :max caracteres.",
            "numero.min" => "O campo número deve ter no mínimo :min caracteres.",
            "bairro.required" => "O campo bairro é obrigatório.",
            "bairro.string" => "O campo bairro deve ser uma string.",
            "bairro.max" => "O campo bairro deve ter no máximo :max caracteres.",
            "bairro.min" => "O campo bairro deve ter no mínimo :min caracteres.",
            "cidade.required" => "O campo cidade é obrigatório.",
            "cidade.string" => "O campo cidade deve ser uma string.",
            "cidade.max" => "O campo cidade deve ter.",
            "cidade.min" => "O campo cidade deve ter no mínimo :min caracteres.",
            "cep.required" => "O campo cep é obrigatório.",
            "cep.string" => "O campo cep deve ser uma string.",
            "cep.max" => "O campo cep deve ter no máximo :max caracteres.",
            "estado.required" => "O campo estado é obrigatório.",
            "estado.string" => "O campo estado deve ser uma string.",
            "estado.max" => "O campo estado deve ter no máximo :max caracteres.",
            "medida_id.required" => "O campo medida é obrigatório.",
            "medida_id.exists" => "O campo medida deve ser uma medida existente.",

        ];
    }
}
