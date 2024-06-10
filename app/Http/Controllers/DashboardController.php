<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PayrollDetail;
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

        // Hitung total basic_salary dari payroll_details
        $totalPaid = PayrollDetail::sum('basic_salary');

        // hitung total unpaid basic salary
        $totalUnpaid = (Employee::sum('salary'))-$totalPaid;

        //total tunjangan
        $totalAllowances = PayrollDetail::sum('allowances');

        //total pengurangan
        $totalDeductions = PayrollDetail::sum('deductions');

        //total seluruh gaji terbayar
        $totalAll = $totalPaid + $totalAllowances - $totalDeductions;

        return view('dashboard.index', compact('totalDeductions','totalAll','totalAllowances','unpaidEmployees', 'totalEmployees', 'paidEmployeesCount', 'unpaidEmployeesCount', 'totalPaid','totalUnpaid'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
