<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Models\Payroll;
use App\Models\Employee;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::all();
        return view('payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        $employeesJson = json_encode($employees);

        return view('payroll.create', compact('employees', 'employeesJson'));
    }

    public function store(StorePayrollRequest $request)
    {
        $validated = $request->validated();

        $payroll = new Payroll;
        $payroll->payroll_date = $validated['payroll_date'];
        $payroll->save();

        return var_dump($validated);

        // foreach ($validated['employee_id'] as $index => $employee_id) {
        //     $payroll->details()->create([
        //         'employee_id' => $employee_id,
        //         'basic_salary' => $validated['basic_salary'][$index],
        //         'allowances' => $validated['allowances'][$index],
        //         'deductions' => $validated['deductions'][$index],
        //     ]);
        // }

        return redirect()->route('payroll.index')->with('success', 'Payroll created successfully.');
    }

    public function show(Payroll $payroll)
    {
        return view('payroll.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('payroll.edit', compact('payroll', 'employees'));
    }

    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        $validated = $request->validated();

        $payroll->payroll_date = $validated['payroll_date'];
        $payroll->save();

        $payroll->details()->delete();

        foreach ($validated['employee_id'] as $index => $employee_id) {
            $payroll->details()->create([
                'employee_id' => $employee_id,
                'basic_salary' => $validated['basic_salary'][$index],
                'allowances' => $validated['allowances'][$index],
                'deductions' => $validated['deductions'][$index],
            ]);
        }


        return redirect()->route('payroll.index')->with('success', 'Payroll successfully updated.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payroll.index')->with('success', 'Payroll successfully deleted.');
    }
}
