<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="flex flex-col">
        <div class="flex flex-row w-full justify-between p-6">
            <h3 class="font-bold text-xl">Unpaid Employees</h3>
            <a href="{{ route('employee.index') }}" class="text-primary-600">See All >></a>
        </div>
        <div class="w-full overflow-x-scroll">
            <table class="min-w-full border divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Id</span>
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
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                    @foreach($unpaidEmployees as $index => $employee)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ $employee->formatted_id }}
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
                            @php
                            $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
                            $salary = $formatter->formatCurrency($employee->salary, 'IDR');
                            @endphp

                            {{ $salary }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ $employee->is_paid_this_month ? 'Paid' : 'Not Paid'}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $unpaidEmployees->links('components.pagination') }}
        </div>
    </div>
</div>