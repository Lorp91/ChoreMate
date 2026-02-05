<?php

namespace App\Http\Requests\Household;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreHouseHoldRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name ist ein Pflichtfeld.',
            'name.max' => 'Name darf nicht laenger als 255 Zeichen sein.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            back()
                ->withErrors($validator)
                ->with('openModal', 'household_create')
                ->withInput()
        );
    }
}
