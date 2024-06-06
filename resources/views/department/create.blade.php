<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Create Department') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" action="{{ route('department.store') }}" method="POST">
            @csrf
            @include('department.partials.department-form')
            @include('department.partials.action-department-form')
        </form>
    </div>
</x-app-layout>