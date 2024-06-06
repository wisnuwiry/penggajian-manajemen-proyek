<form id="payroll-form" action="{{ isset($payroll) ? route('payroll.update', $payroll->id) : route('payroll.store') }}" method="POST">
    @csrf
    @if(isset($payroll))
    @method('PUT')
    @endif

    <section class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Employees') }}
            </h2>
        </header>
        <hr class="mt-4">
        <div id="employees-container">
            <div class="employee-entries">
                @foreach(old('employee_id', isset($payroll) ? $payroll->employees->pluck('id')->toArray() : ['']) as $index => $employee_id)
                <div class="flex flex-col mt-4 gap-6 employee-entry" id="employee_entry_{{ $index }}">
                    <div class="flex flex-col md:flex-row flex-wrap gap-4">
                        <div class="flex-1">
                            <x-input-label for="employee_id_{{ $index }}" :value="__('Employee')" />
                            <select id="employee_id_{{ $index }}" name="employee_id[]" class="employee-select border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Select Employee</option>
                            </select>
                            <x-input-error :messages="$errors->get('employee_id.'.$index)" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="basic_salary_{{ $index }}" :value="__('Basic Salary')" />
                            <input id="basic_salary_{{ $index }}" name="basic_salary[]" value="{{ old('basic_salary.'.$index, isset($payroll) ? $payroll->details[$index]->basic_salary : '') }}" type="number" class="basic-salary border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" readonly required />
                            <x-input-error :messages="$errors->get('basic_salary.'.$index)" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row flex-wrap gap-4">
                        <div class="flex-1">
                            <x-input-label for="allowances_{{ $index }}" :value="__('Allowances')" />
                            <x-text-input id="allowances_{{ $index }}" class="allowances" name="allowances[]" value="{{ old('allowances.'.$index, 0) }}" type="number" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('allowances.'.$index)" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="deductions_{{ $index }}" :value="__('Deductions')" />
                            <x-text-input id="deductions_{{ $index }}" class="deductions" name="deductions[]" value="{{ old('deductions.'.$index, 0) }}" type="number" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('deductions.'.$index)" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex w-full justify-start">
                        <x-danger-button type="button" class="remove-employee">Delete</x-danger-button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <hr class="mt-4">
        <div class="flex w-full justify-end py-4">
            <x-primary-button id="add-employee" type="button">Add Employee</x-primary-button>
        </div>
    </section>

    <section class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Summary') }}
            </h2>
        </header>
        <hr class="my-4">
        <div id="summary-container" class="w-full overflow-x-scroll">
            <table class="min-w-full border divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">No</span>
                        </th>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Employee</span>
                        </th>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Basic Salary</span>
                        </th>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Allowances</span>
                        </th>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Deductions</span>
                        </th>
                        <th class="bg-gray-50 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Take Home Pay</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 divide-solid" id="summary-table-body">
                </tbody>
            </table>
            <div class="flex w-full justify-end mt-6">
                <h4 class="font-bold text-2xl py-4 px-8 bg-primary-100 rounded-lg cursor-pointer">Total: <span id="total_take_home_pay">-</span></h4>
            </div>
        </div>
    </section>

    <section class="p-4 sm:p-8 bg-white shadow rounded-lg">
        <div class="flex flex-col md:flex-row flex-wrap gap-4 max-w-7xl m-auto">
            <div class="flex-1">
                <x-input-label for="payroll_date" :value="__('Payroll Date')" />
                <input id="payroll_date" name="payroll_date" value="{{ old('payroll_date', isset($payroll) ? $payroll->payroll_date->format('Y-m-d') : '') }}" type="date" class="border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('payroll_date')" class="mt-2" />
            </div>
            <div class="flex-1 flex justify-end">
                <button class="inline-flex items-center px-12 py-2 bg-primary-500 border border-transparent rounded-lg font-semibold text-lg text-white focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ isset($payroll) ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </section>
</form>

<script>
    let selectedEmployees = [];
    const allEmployee = $.map(JSON.parse(@json($employeesJson)), function(obj) {
        obj.text = obj.first_name + ' ' + obj.last_name;
        obj.salary = obj.salary;

        return obj;
    });

    $(document).ready(function() {
        // Function to update the salary based on selected employee
        function updateSalary(selectElement, index) {
            const employee = allEmployee.find((o) => o.id === Number.parseInt(selectElement.params.data.id));
            $(`#basic_salary_${index}`).val(employee.salary);
            updateSummary();
        }

        // Function to update the summary
        function updateSummary() {
            const summaryTableBody = $('#summary-table-body');
            summaryTableBody.html('');
            let total = 0;
            $('.employee-entry').each(function(index, entry) {
                const employeeName = $(entry).find('.employee-select option:selected').text();
                const basicSalary = parseFloat($(entry).find('.basic-salary').val()) || 0;
                const allowances = parseFloat($(`#allowances_${index}`).val()) || 0;
                const deductions = parseFloat($(`#deductions_${index}`).val()) || 0;
                const netSalary = basicSalary + allowances - deductions;
                let rupiah = Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                total += netSalary;

                summaryTableBody.append(`
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            ${index + 1}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            ${employeeName}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            ${rupiah.format(basicSalary)}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            ${rupiah.format(allowances)}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            ${rupiah.format(deductions)}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            ${rupiah.format(netSalary)}
                        </td>
                    </tr>
                `);
                $('#total_take_home_pay').text(`${rupiah.format(total)}`);
            });
        }

        // Show or hide remove button based on employee entry count
        function updateRemoveButtonVisibility() {
            const employeeEntries = $('.employee-entry');
            const removeButtons = $('.remove-employee');
            if (employeeEntries.length > 1) {
                removeButtons.show();
            } else {
                removeButtons.hide();
            }
        }

        // Disable all employee selector
        function disableEmployeesSelector() {
            const length = $('.employee-select').length;

            for (let index = 0; index < length; index++) {
                $(`employee_id_${index}`).select2("readonly", false);
            }
        }

        // Add employee entry
        $('#add-employee').click(function() {
            const lastEntry = $('.employee-entry').last();
            const newIndex = $('.employee-entry').length;

            if (validateEntry(newIndex - 1)) {
                disableEmployeesSelector(); // Update disabled selector

                const employeeEntry = lastEntry.clone(true);
                employeeEntry.find('.employee-select').attr('id', `employee_id_${newIndex}`);
                employeeEntry.find('.basic-salary').attr('id', `basic_salary_${newIndex}`);
                employeeEntry.find('.allowances').replaceWith(`<input class="border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" id="allowances_${newIndex}" name="allowances[]" value="0" type="number">`);
                employeeEntry.find('.deductions').replaceWith(`<input class="border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" id="deductions_${newIndex}" name="deductions[]" value="0" type="number">`);
                employeeEntry.find(`#employee_id_${newIndex}`).replaceWith(`<select id="employee_id_${newIndex}" name="employee_id[]" class="employee-select border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full"><option value="">Select Employee</option></select>`);
                employeeEntry.find('.select2-container').remove();

                employeeEntry.find('.basic-salary').val('');
                employeeEntry.find('.allowances').val('0');
                employeeEntry.find('.deductions').val('0');
                $('#employees-container').append(employeeEntry);

                updateRemoveButtonVisibility();
                initializeSelect(newIndex);
            } else {
                alert('Please complete the current employee form before adding a new one.');
            }
        });

        // Remove employee entry
        $(document).on('click', '.remove-employee', function() {
            $(this).closest('.employee-entry').remove();

            updateSummary();
            updateRemoveButtonVisibility();
            disableEmployeesSelector(); // Update disabled options
        });

        // Update summary on allowances or deductions input
        $(document).on('input', function() {
            updateSummary();
        });

        // Validate entry
        function validateEntry(index) {
            const selectEmployeeElement = $(`#employee_id_${index}`).select2("data");
            const employeeId = Number.parseInt(selectEmployeeElement[0].id);
            console.log(employeeId);
            if (employeeId === null || employeeId === undefined || employeeId === NaN) return false;

            const employee = allEmployee.find((o) => o.id === employeeId);
            const basicSalary = $(`#basic_salary_${index}`).val() || 0;
            const allowances = $(`#allowances_${index}`).val() || 0;
            const deductions = $(`#deductions_${index}`).val() || 0;

            return employee?.id !== null && basicSalary > 0;
        }

        function initializeSelect(index) {
            const e = $(`#employee_id_${index}`).select2({
                placeholder: 'Select Employee',
                data: allEmployee.map((obj) => {
                    if (selectedEmployees.includes(obj.id)) {
                        obj.disabled = true;
                    }

                    return obj;
                }),
            });

            e.on('select2:select', function(element) {
                selectedEmployees.push(Number.parseInt(element.params.data.id));
                updateSalary(element, index);
                disableEmployeesSelector();
            });
        }

        // Initialize remove button visibility and disable options on page load
        updateRemoveButtonVisibility();
        disableEmployeesSelector();
        initializeSelect(0);
    });
</script>