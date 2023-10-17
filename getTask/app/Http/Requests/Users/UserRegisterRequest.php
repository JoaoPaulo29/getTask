<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required|text',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'O campo EMAIL é obrigatório!',
            'email.email' => 'O campo EMAIL deve ser do tipo email!',
            'password.required' => 'O campo Senha é obrigatório!',
            'password.min' => 'Deve conter no min 6 carateres',
        ];
    }
}
