<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // List of employees unpaid this month
        $unpaidEmployees = Employee::whereDoesntHave('payrolls', function($query) use ($currentMonth, $currentYear) {
            $query->whereYear('payrolls.payroll_date', $currentYear)
                  ->whereMonth('payrolls.payroll_date', $currentMonth);
        })->orderByDesc('created_at')->paginate(10);

        // Total number of employees
        $totalEmployees = Employee::count();

        // Total number of employees paid this month
        $paidEmployeesCount = Employee::whereHas('payrolls', function($query) use ($currentMonth, $currentYear) {
            $query->whereYear('payrolls.payroll_date', $currentYear)
                  ->whereMonth('payrolls.payroll_date', $currentMonth);
        })->count();

        // Total number of employees unpaid this month
        $unpaidEmployeesCount = $totalEmployees - $paidEmployeesCount;

        return view('dashboard.index', compact('unpaidEmployees', 'totalEmployees', 'paidEmployeesCount', 'unpaidEmployeesCount'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
