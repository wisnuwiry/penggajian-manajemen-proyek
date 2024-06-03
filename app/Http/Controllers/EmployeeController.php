<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::orderByDesc('created_at')->paginate(10);

        return view('employee.index', compact('employees'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create() : View {
        $departments = Department::all();
        $positions = Position::all();

        return view('employee.create', compact('departments', 'positions'));    
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse {
        try {
            Employee::create($request->validated());
            return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->withErrors('Failed to create employee.');
        }
    }

    public function edit(Employee $employee): View {
        $departments = Department::all();
        $positions = Position::all();

        return view('employee.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse {
        try {
            $employee->update($request->validated());
            return redirect()->route('employee.index')->with('success', 'Employee update successfully.');
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->withErrors('Failed to update employee.');
        }
    }

    public function destroy(Employee $employee) {
        $employee->delete();

        return to_route('employee.index');
    }
}
