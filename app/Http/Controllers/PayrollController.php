<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\PayrollDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::orderByDesc('created_at')->paginate(10);
        return view('payroll.index', compact('payrolls'))->with('i', (request()->input('page', 1) - 1) * 10);
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

        foreach ($validated['employee_id'] as $index => $employee_id) {
            // Define the storage path
            $storagePath = storage_path('app/payslips');

            // Ensure the directory exists
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0755, true);
            }

            // Define the PDF file path
            $pdfPath = 'payslips/payslip_' . $payroll->id . '_employee_' . $employee_id . '_' . date('d-M-Y') . '.pdf';

            // Save to PayrollDetail
            $detail = $payroll->details()->create([
                'employee_id' => $employee_id,
                'basic_salary' => $validated['basic_salary'][$index],
                'allowances' => $validated['allowances'][$index],
                'deductions' => $validated['deductions'][$index],
                'pdf_path' => $pdfPath,
            ]);

            $pdf = Pdf::loadView('pdf.payslip', ['detail' => $detail, 'payroll' => $payroll]);

            // Save PDF to storage
            $pdf->save(storage_path('app/' . $pdfPath));
        }

        return redirect()->route('payroll.show', compact('payroll'))->with('success', 'Payroll created successfully.');
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

    public function download($id)
    {
        $detail = PayrollDetail::findOrFail($id);
        $filePath = storage_path('app/' . $detail->pdf_path);

        if (!file_exists($filePath)) {
            abort(404, 'Payslip not found.');
        }

        return response()->download($filePath, basename($filePath), [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function getPayslipToken($id)
    {
        $detail = PayrollDetail::findOrFail($id);

        // Generate a secure token
        $token = Str::random(40);
        $expiresAt = Carbon::now()->addMinutes(15);

        // Store the token in cache with a 15-minute expiration
        Cache::put($token, $detail->pdf_path, $expiresAt);

        return response()->json([
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    public function showPayslipWithToken($token)
    {
        $filePath = Cache::get($token);
        Log::info($filePath);

        if (!$filePath) {
            abort(404, 'Payslip not found or token expired.');
        }

        $fullPath = storage_path('app/' . $filePath);

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
