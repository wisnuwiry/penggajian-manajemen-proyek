<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::all();

        return view('employee.index', compact('employees'));
    }

    public function detail(Employee $employee): View
    {
        return view('employee.index', compact('employee'));
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
        return view('employee.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse {
        $employee->update($request->validate());

        return to_route('employee.index');
    }

    public function delete(Employee $employee) {
        $employee->delete();

        return to_route('employee.index');
    }
}
