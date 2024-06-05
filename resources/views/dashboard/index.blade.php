<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-8">
            @include('dashboard.partials.greeting')
            @include('dashboard.partials.balance')
            @include('dashboard.partials.employee', ['totalEmployees' => $totalEmployees, 'paidEmployeesCount' => $paidEmployeesCount, 'unpaidEmployeesCount' => $unpaidEmployeesCount])
            @include('dashboard.partials.unpaid-employee-table', ['unpaidEmployees' => $unpaidEmployees])
        </div>
    </div>
</x-app-layout>