<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" action="{{ route('employee.update', $employee) }}" method="POST">
            @method('PUT')
            @csrf
            @include('employee.partials.general-employee-form')
            @include('employee.partials.contact-employee-form')
            @include('employee.partials.employee-info-form')
            @include('employee.partials.action-employee-form')
        </form>
    </div>
</x-app-layout>