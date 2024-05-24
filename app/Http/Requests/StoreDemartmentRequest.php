<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemartmentRequest extends FormRequest
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
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'manager_id' => 'nullable|exists:employees,id',
        ];
    }

    public function messages()
    {
        return [
            'department_name.required' => 'The department name field is required.',
            'manager_id.exists' => 'The selected manager is invalid or does not exist.',
        ];
    }
}
