<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemartmentRequest;
use App\Http\Requests\UpdateDemartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function ajax()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function index(): View
    {
        $departments = Department::orderByDesc('created_at')->paginate(10);

        return view('department.index', compact('departments'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create() : View {
        $managers = Employee::get();

        return view('department.create', compact('managers'));    
    }

    public function store(StoreDemartmentRequest $request): RedirectResponse {
        try {
            Department::create($request->validated());
            return redirect()->route('department.index')->with('success', 'Department created successfully.');
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->withErrors('Failed to create department.');
        }
    }

    public function edit(Department $department): View {
        $managers = Employee::get();

        return view('department.edit', compact('department', 'managers'));
    }

    public function update(UpdateDemartmentRequest $request, Department $department): RedirectResponse {
        try {
            $department->update($request->validated());
            return redirect()->route('department.index')->with('success', 'Department update successfully.');
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->withErrors('Failed to update department.');
        }
    }

    public function destroy(Department $department) {
        $department->delete();

        return to_route('department.index');
    }
}
