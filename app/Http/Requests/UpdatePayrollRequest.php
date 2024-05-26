<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollRequest extends FormRequest
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
            'employee_id.*' => 'required|exists:employees,id',
            'basic_salary.*' => 'required|numeric|min:0',
            'allowances.*' => 'nullable|numeric|min:0',
            'deductions.*' => 'nullable|numeric|min:0',
            'payroll_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.*.required' => 'Employee selection is required.',
            'employee_id.*.exists' => 'The selected employee is invalid.',
            'basic_salary.*.required' => 'Basic salary is required.',
            'basic_salary.*.numeric' => 'Basic salary must be a number.',
            'basic_salary.*.min' => 'Basic salary must be at least 0.',
            'allowances.*.numeric' => 'Allowances must be a number.',
            'allowances.*.min' => 'Allowances must be at least 0.',
            'deductions.*.numeric' => 'Deductions must be a number.',
            'deductions.*.min' => 'Deductions must be at least 0.',
            'payroll_date.required' => 'Payroll date is required.',
            'payroll_date.date' => 'Payroll date is not a valid date.',
        ];
    }
}
