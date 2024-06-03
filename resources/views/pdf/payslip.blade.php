<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payslip: {{ $detail->employee->first_name }} {{ $detail->employee->last_name }} - {{ date('d M Y', strtotime($payroll->payroll_date)); }}</title>
    <style>
        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ asset('img/logo.png') }}" height="42" />
            </td>
            <td class="w-half">
                <h2>PAYSLIP</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>To:</h4>
                    </div>
                    <div>John Doe</div>
                    <div>123 Acme Str.</div>
                </td>
                <td class="w-half">
                    <div>
                        <h4>From:</h4>
                    </div>
                    <div>Laravel Daily</div>
                    <div>London</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <tr class="items">

            </tr>
        </table>
    </div>

    <div class="total">
        Total: $129.00 USD
    </div>

    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Laravel Daily</div>
    </div>
    @php
    $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
    @endphp
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="left">
                <div class="company-info">
                    <img src='{{ url("/img/logo.png") }}' class="logo">
                    <h1 class="font-bold" style="font-size: 20px;">PT. Wira Wiri</h1>
                </div>
                <p><span style="margin-top: 10px; font-weight: bold;">Address:</span> Menara Tower Ngga Jelas Jalan Patimura Selatan sampai kiri no. 23</p>
                <p><span style="font-weight: bold;">Phone:</span> 08287283239</p>
            </div>
            <div class="right">
                <div class="payslip-info">
                    <h2 style="font-weight: bold; font-size: 22px; text-decoration: underline; text-underline-offset: 6px;">PAYSLIP</h2>
                    <h3 style="font-weight: bold; font-size: 18px">{{ date('d M Y', strtotime($payroll->payroll_date)); }}</h3>
                </div>
            </div>
        </div>

        <!-- Spacing -->
        <hr />

        <!-- Employee Info -->
        <div class="employee-info">
            <div class="left">
                <div class="row">
                    <p class="label">Name</p>
                    <p class="value">{{ $detail->employee->first_name }} {{ $detail->employee->last_name }}</p>
                </div>
                <div class="row">
                    <p class="label">Position</p>
                    <p class="value">{{ $detail->employee->position->position_name }}</p>
                </div>
                <div class="row">
                    <p class="label">Department</p>
                    <p class="value">{{ $detail->employee->department->department_name }}</p>
                </div>
            </div>
            <div class="right">
                <div class="row">
                    <p class="label">Date Start Working</p>
                    <p class="value">{{ date('d/M/Y', strtotime($detail->employee->created_at)); }}</p>
                </div>
                <div class="row">
                    <p class="label">Employee Type</p>
                    <p class="value">Permanent</p>
                </div>
            </div>
        </div>

        <!-- Spacing -->
        <hr />

        <!-- Details -->
        <div class="details">
            <div class="left">
                <div class="section">
                    <hr />
                    <div class="title">Income</div>
                    <hr />
                    <div class="item">
                        <div class="row">
                            <p class="label">Base Salary</p>
                            <p class="value">{{ $formatter->formatCurrency($detail->employee->salary, 'IDR') }}</p>
                        </div>
                        <div class="row">
                            <p class="label">Allowance</p>
                            <p class="value">{{ $formatter->formatCurrency($detail->allowance, 'IDR') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="section">
                    <hr />
                    <div class="title">Deduction</div>
                    <hr />
                    <div class="item">
                        <div class="row">
                            <p class="label">Deduction</p>
                            <p class="value">{{ $formatter->formatCurrency($detail->deduction, 'IDR') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spacing -->
        <hr />

        <!-- Take Home Pay -->
        <div class="take-home-pay">
            <p class="label">Take Home Pay</p>
            <p class="value">{{ $formatter->formatCurrency($detail->take_home_pay, 'IDR') }}</p>
        </div>
    </div>
</body>

</html>