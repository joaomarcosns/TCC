<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmed' => 'required|same:password',
            'perfil_id' => 'required|exists:perfil,id',
            'propriedade_id' => 'required|exists:propriedade,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'email.unique' => 'O e-mail informado já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password_confirmed.required' => 'O campo confirmação de senha é obrigatório.',
            'password_confirmed.same' => 'A confirmação de senha deve ser igual a senha.',
            'perfil_id.required' => 'O campo perfil é obrigatório.',
            'perfil_id.exists' => 'O perfil informado não existe.',
            'propriedade_id.required' => 'O campo propriedade é obrigatório.',
            'propriedade_id.exists' => 'A propriedade informada não existe.',
        ];
    }
}
