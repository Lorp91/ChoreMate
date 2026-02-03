<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-Mail ist ein Pflichtfeld.',
            'email.email' => 'E-Mail muss eine gueltige E-Mail Adresse sein.',
            'email.max' => 'E-Mail darf maximal 255 Zeichen lang sein.',
            'password.required' => 'Passwort ist ein Pflichtfeld.',
            'password.min' => 'Passwort muss mindestens 8 Zeichen lang sein.',
            'password.max' => 'Passwort darf maximal 255 Zeichen lang sein.',
        ];
    }
}
