<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name ist ein Pflichtfeld.',
            'name.max' => 'Name darf nicht laenger als 255 Zeichen sein.',
            'email.required' => 'Email ist ein Pflichtfeld.',
            'email.email' => 'Email muss eine gueltige E-Mail Adresse sein.',
            'email.max' => 'E-Mail darf nicht laenger als 255 Zeichen sein.',
            'password.required' => 'Passwort ist ein Pflichtfeld.',
            'password.min' => 'Passwort muss mindestens 8 Zeichen lang sein.',
            'password.max' => 'Passwort darf nicht laenger als 255 Zeichen sein.',
        ];
    }
}
