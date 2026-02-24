<?php

namespace App\Http\Requests\App\Household;

use Illuminate\Foundation\Http\FormRequest;

class StoreHouseHoldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $household = $this->route('household');

        return $this->user()->can('create', $household);
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
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name ist ein Pflichtfeld.',
            'name.max' => 'Name darf nicht laenger als 255 Zeichen sein.',
            'description.max' => 'Beschreibung darf nicht laenger als 255 Zeichen sein.',
        ];
    }
}
