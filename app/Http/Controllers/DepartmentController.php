<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
        $departments = Department::all();

        return view('department.index', compact('departments'));
    }
}
