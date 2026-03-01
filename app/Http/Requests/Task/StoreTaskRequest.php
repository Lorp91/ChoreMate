<?php

namespace App\Http\Requests\Task;

use App\Enums\IntervalUnit;
use App\Enums\MembershipStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('view', $this->route('household'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'repeat_interval' => ['nullable', 'integer'],
            'interval_unit' => ['nullable', Rule::enum(IntervalUnit::class)],
            'user_id' => [
                'nullable',
                Rule::exists('users', 'id'),
                Rule::exists('household_memberships', 'user_id')
                    ->where('household_id', $this->route('household')->id)
                    ->where('status', MembershipStatus::ACTIVE->label()),
            ],
        ];
    }
}
