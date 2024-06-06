<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Payroll Detail') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('payroll.partials.payroll-detail-summary', ['payroll' => $payroll])
            @include('payroll.partials.payroll-detail-payslip', ['payroll' => $payroll])
        </div>
    </div>
</x-app-layout>