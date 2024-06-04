<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            padding: 4rem 2rem;
            font-size: 16px;
        }

        h2 {
            font-size: 20px;
        }

        .v-middle {
            vertical-align: middle;
        }

        .font-bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-spacing: 2px;
        }

        .w-70 {
            width: 68%;
        }

        .w-50 {
            width: 48%;
        }

        .w-30 {
            width: 32%;
        }

        .w-100 {
            width: 98%;
        }

        .align-right {
            text-align: right;
        }

        hr {
            color: #ccc;
            background: #ccc;
            border: 1px solid #ccc;
        }

        td {
            padding: 2px 10px;
        }

        tr {
            margin: 4px 0;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .v-border {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        .m-auto {
            margin: auto;
        }

        .text-end {
            text-align: end;
        }

        .take-home-pay {
            padding: 1rem;
            background: #f4f3f3;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    @php
    $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
    @endphp
    <table>
        <thead>
            <tr>
                <td>
                    <div>
                        <img class="v-middle" src="data:image/png;base64,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" alt="" width="40px">
                        <h2 class="v-middle" style="margin-top: 10px;">PT. Wira Wiri</h2>
                    </div>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-top: 20px"><span class="font-bold">Address:</span> Menara Tower Ngga Jelas Jalan Patimura Selatan sampai kiri no. 23</td>
                <td>
                    <h2 style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color: #ccc;">PAYSLIP</h2>
                </td>
            </tr>
            <tr>
                <td><span class="font-bold">Phone:</span> 08283238782</td>
                <td>
                    <h3 style="margin-top: 8px">{{ date('d M Y', strtotime($payroll->payroll_date)); }}</h3>
                </td>
            </tr>
        </tbody>
    </table>

    <hr class="mt-20" />

    <table class="mt-20">
        <tbody>
            <tr>
                <td class="font-bold w-30">Name</td>
                <td class="text-end">{{ $detail->employee->first_name }} {{ $detail->employee->last_name }}</td>
                <td class="font-bold w-30">Date Start Working</td>
                <td class="text-end">{{ date('d/M/Y', strtotime($detail->employee->created_at)); }}</td>
            </tr>
            <tr>
                <td class="font-bold">Position</td>
                <td class="text-end">{{ $detail->employee->position->position_name }}</td>
                <td class="font-bold">Employee Type</td>
                <td class="text-end">Permanent</td>
            </tr>
            <tr>
                <td class="font-bold">Department</td>
                <td class="text-end">{{ $detail->employee->department->department_name }}</td>
                <td class="font-bold"></td>
                <td class="text-end"></td>
            </tr>
        </tbody>
    </table>

    <hr class="mt-20" />

    <table class="mt-20">
        <thead>
            <tr class="font-bold">
                <td class="w-30">Incomes</td>
                <td class="text-end">Total (IDR)</td>
                <td class="w-30">Deductions</td>
                <td class="text-end">Total (IDR)</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Base Salary</td>
                <td class="text-end">{{ $formatter->formatCurrency($detail->employee->salary, 'IDR') }}</td>
                <td>Deduction</td>
                <td class="text-end">{{ $formatter->formatCurrency($detail->deduction, 'IDR') }}</td>
            </tr>

            <tr>
                <td>Allowance</td>
                <td class="text-end">{{ $formatter->formatCurrency($detail->allowance, 'IDR') }}</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
   
    <hr class="mt-20" />

    <table class="take-home-pay mt-20">
        <thead>
            <tr>
                <td class="w-50"><h2>Take Home Pay</h2></td>
                <td class="w-50 text-end"><h2>{{ $formatter->formatCurrency($detail->take_home_pay, 'IDR') }}</h2></td>
            </tr>
        </thead>
    </table>
</body>

</html>