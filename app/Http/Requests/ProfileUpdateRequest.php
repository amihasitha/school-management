<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required_if:user_type,super_admin',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nic' => ['nullable', 'string'],
            'first_appointment_date' => ['nullable', 'date'],
            'dob' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'date_current_appointment_school' => ['nullable', 'date'],
            'appointment_subject' => ['nullable', 'string']
        ];
    }
}
