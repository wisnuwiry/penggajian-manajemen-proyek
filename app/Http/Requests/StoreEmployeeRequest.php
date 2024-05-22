<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name'      => 'required|string|max:50',
            'last_name'       => 'required|string|max:50',
            'birth_date'      => 'required|date',
            'hire_date'       => 'required|date',
            'nik'             => 'required|numeric|digits:16',
            'department_id'   => 'required|exists:departments,id',
            'position_id'     => 'required|exists:positions,id',
            'email'           => 'required|email|unique:employees,email',
            'phone_number'    => 'nullable|string|max:15',
            'address'         => 'nullable|string',
            'salary'          => 'required|numeric|min:0',
            'bank_name'       => 'required|string',
            'bank_account_number'   => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'    => 'First name is required.',
            'first_name.string'      => 'First name must be a string.',
            'first_name.max'         => 'First name may not be greater than 50 characters.',
            'last_name.required'     => 'Last name is required.',
            'last_name.string'       => 'Last name must be a string.',
            'last_name.max'          => 'Last name may not be greater than 50 characters.',
            'birth_date.required'    => 'Birth date is required.',
            'birth_date.date'        => 'Birth date must be a valid date.',
            'hire_date.required'     => 'Hire date is required.',
            'hire_date.date'         => 'Hire date must be a valid date.',
            'nik.required'           => 'NIK is required.',
            'nik.numeric'            => 'NIK must be a number.',
            'nik.digits'             => 'NIK must be exactly 16 digits.',
            'department_id.required' => 'Department is required.',
            'department_id.exists'   => 'Selected department does not exist.',
            'position_id.required'   => 'Position is required.',
            'position_id.exists'     => 'Selected position does not exist.',
            'email.required'         => 'Email is required.',
            'email.email'            => 'Email must be a valid email address.',
            'email.unique'           => 'Email has already been taken.',
            'phone_number.string'    => 'Phone number must be a string.',
            'phone_number.max'       => 'Phone number may not be greater than 15 characters.',
            'address.string'         => 'Address must be a string.',
            'salary.required'        => 'Salary is required.',
            'salary.numeric'         => 'Salary must be a number.',
            'salary.min'             => 'Salary must be at least 0.',
            'bank_name.required'     => 'Bank name is required.',
            'bank_name.string'       => 'Bank name must be a string.',
            'bank_account_number.required'   => 'Bank account number is required.',
            'bank_account_number.numeric'    => 'Bank account number must be a number.',
        ];
    }
}
