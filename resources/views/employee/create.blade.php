<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('employee.partials.general-employee-form')
            @include('employee.partials.contact-employee-form')
            @include('employee.partials.employee-info-form')
            @include('employee.partials.action-employee-form')
        </div>
    </div>
</x-app-layout>