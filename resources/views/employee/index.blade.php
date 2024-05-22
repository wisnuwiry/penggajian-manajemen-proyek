<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 space-y-4">
                <div class="flex flex-row justify-between px-4">
                    <div></div>
                    <x-primary-button-link href="{{ route('employee.create') }}">
                        {{ __('Add Employee') }}
                    </x-primary-button-link>
                </div>
                <div class="min-w-full align-middle">
                    <table class="min-w-full border divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">ID</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Name</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Department</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Position</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Salary</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Status</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Action</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($employees as $employee)
                            <tr class="bg-white">
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $employee->id }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $employee->first_name }} {{ $employee->last_name }} 
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $employee->department->department_name }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $employee->position->position_name }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $employee->salary }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    Tergaji
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    <a href="{{ route('employee.edit', $employee) }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                        Edit
                                    </a>
                                    <form action="{{ route('employee.destroy', $employee) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>
                                            Delete
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h1>Test</h1>
            </div>
        </div>
    </div>
</x-app-layout>