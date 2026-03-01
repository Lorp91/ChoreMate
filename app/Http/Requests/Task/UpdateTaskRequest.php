<?php

namespace App\Http\Requests\Task;

use App\Enums\IntervalUnit;
use App\Enums\MembershipStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'title' => ['sometimes', 'string'],
            'description' => ['sometimes', 'nullable', 'string'],
            'due_date' => ['sometimes', 'nullable', 'date'],
            'repeat_interval' => ['sometimes', 'nullable', 'integer'],
            'interval_unit' => ['sometimes', 'nullable', Rule::enum(IntervalUnit::class)],
            'user_id' => [
                'sometimes',
                'nullable',
                Rule::exists('users', 'id'),
                Rule::exists('household_memberships', 'user_id')
                    ->where('household_id', $this->route('task')->room->household->id)
                    ->where('status', MembershipStatus::ACTIVE->label()),
            ],
        ];
    }
}
