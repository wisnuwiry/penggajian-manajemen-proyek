<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PayrollController extends Controller
{
    public function index(): View
    {
        return view('payroll.index');
    }
}
