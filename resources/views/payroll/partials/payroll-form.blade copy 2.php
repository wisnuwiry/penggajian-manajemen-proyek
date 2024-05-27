<form id="payroll-form" action="{{ isset($payroll) ? route('payroll.update', $payroll->id) : route('payroll.store') }}" method="POST">
    @csrf
    @if(isset($payroll))
        @method('PUT')
    @endif

    <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" id="employees-container">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Employees') }}
            </h2>
        </header>
        <hr class="mt-4">
        <div class="employee-entries">
            @foreach(old('employee_id', isset($payroll) ? $payroll->employees->pluck('id')->toArray() : ['']) as $index => $employee_id)
                <div class="flex flex-col mt-4 gap-6 employee-entry">
                    <div class="flex justify-between">
                        <h3>Employee {{ $index + 1 }}</h3>
                        @if($index > 0)
                            <x-danger-button type="button" class="remove-employee">Delete</x-danger-button>
                        @endif
                    </div>
                    <div class="flex flex-col md:flex-row flex-wrap gap-4">
                        <div class="flex-1">
                            <x-input-label for="employee_id_{{ $index }}" :value="__('Employee')" />
                            <select id="employee_id_{{ $index }}" name="employee_id[]" class="employee-select border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" data-salary="{{ $employee->salary }}" {{ (old('employee_id.'.$index) == $employee->id || (isset($payroll) && $employee_id == $employee->id)) ? 'selected' : '' }}>
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </option>
                                @endforeach
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
                </div>
            @endforeach
        </div>

        <hr class="mt-4">
        <div class="flex w-full justify-end py-4">
            <x-primary-button id="add-employee" type="button" disabled>Add Employee</x-primary-button>
        </div>
    </section>

    <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg fixed bottom-0 left-0 right-0">
        <div class="flex flex-col md:flex-row flex-wrap gap-4 max-w-7xl m-auto">
            <div class="flex-1">
                <x-input-label for="payroll_date" :value="__('Payroll Date')" />
                <input id="payroll_date" name="payroll_date" value="{{ old('payroll_date', isset($payroll) ? $payroll->payroll_date->format('Y-m-d') : '') }}" type="date" class="border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('payroll_date')" class="mt-2" />
            </div>
            <div class="flex-1 flex justify-end">
                <button class="inline-flex items-center px-12 py-2 bg-primary-500 border border-transparent rounded-lg font-semibold text-lg text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ isset($payroll) ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </section>

    <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" id="summary-container">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Summary') }}
            </h2>
        </header>
        <hr class="mt-4">
    </section>
    <div class="h-[300px]"></div>
</form>

<script>
    $(document).ready(function() {
        // Function to update the salary based on selected employee
        function updateSalary(selectElement) {
            const salary = $(selectElement).find('option:selected').data('salary');
            $(selectElement).closest('.employee-entry').find('.basic-salary').val(salary);
            updateSummary();
        }

        // Function to update the summary
        function updateSummary() {
            const summaryContainer = $('#summary-container');
            summaryContainer.html('');
            $('.employee-entry').each(function(index, entry) {
                const employeeName = $(entry).find('.employee-select option:selected').text();
                const basicSalary = parseFloat($(entry).find('.basic-salary').val()) || 0;
                const allowances = parseFloat($(entry).find('.allowances').val()) || 0;
                const deductions = parseFloat($(entry).find('.deductions').val()) || 0;
                const netSalary = basicSalary + allowances - deductions;
                summaryContainer.append(`
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Employee ${index + 1}: ${employeeName}</h5>
                            <p class="card-text">Basic Salary: ${basicSalary}</p>
                            <p class="card-text">Allowances: ${allowances}</p>
                            <p class="card-text">Deductions: ${deductions}</p>
                            <p class="card-text">Net Salary: ${netSalary}</p>
                        </div>
                    </div>
                `);
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

        // Check if all employee selects have a value
        function checkEmployeeSelects() {
            let allSelected = true;
            $('.employee-select').each(function() {
                if ($(this).val() === "") {
                    allSelected = false;
                }
            });
            $('#add-employee').prop('disabled', !allSelected);
        }

        // Add employee entry
        $('#add-employee').click(function() {
            const lastEntry = $('.employee-entry').last();
            if (validateEntry(lastEntry)) {
                const newIndex = $('.employee-entry').length;
                const employeeEntry = lastEntry.clone(true);
                employeeEntry.find('.employee-select').attr('id', `employee_id_${newIndex}`);
                employeeEntry.find('.basic-salary').attr('id', `basic_salary_${newIndex}`);
                employeeEntry.find('.allowances').attr('id', `allowances_${newIndex}`);
                employeeEntry.find('.deductions').attr('id', `deductions_${newIndex}`);
                employeeEntry.find('.employee-select').val('');
                employeeEntry.find('.basic-salary').val('');
                employeeEntry.find('.allowances').val(0);
                employeeEntry.find('.deductions').val(0);
                employeeEntry.find('h3').text(`Employee ${newIndex + 1}`);
                $('#employees-container').append(employeeEntry);
                updateRemoveButtonVisibility();
                disableSelectedEmployees(); // Update disabled options
                checkEmployeeSelects(); // Check if new entry makes button disabled
            } else {
                alert('Please complete the current employee form before adding a new one.');
            }
        });

        // Remove employee entry
        $(document).on('click', '.remove-employee', function() {
            $(this).closest('.employee-entry').remove();
            updateSummary();
            updateRemoveButtonVisibility();
            disableSelectedEmployees(); // Update disabled options
            checkEmployeeSelects(); // Check if new entry makes button disabled
        });

        // Update salary and summary on employee selection
        $(document).on('change', '.employee-select', function() {
            updateSalary(this);
            disableSelectedEmployees();
            checkEmployeeSelects(); // Check if new entry makes button disabled
        });

        // Update summary on allowances or deductions input
        $(document).on('input', '.allowances, .deductions', function() {
            updateSummary();
        });

        // Disable already selected employees
        function disableSelectedEmployees() {
            const selectedEmployees = $('.employee-select').map(function() {
                return $(this).val();
            }).get();
            $('.employee-select option').prop('disabled', false);
            selectedEmployees.forEach(function(employeeId) {
                $(`.employee-select option[value="${employeeId}"]`).prop('disabled', true);
            });
        }

        // Validate entry
        function validateEntry(entry) {
            let isValid = true;
            entry.find('select, input').each(function() {
                if (!this.checkValidity()) {
                    isValid = false;
                    $(this).siblings('.x-input-error').text('This field is required.');
                } else {
                    $(this).siblings('.x-input-error').text('');
                }
            });
            return isValid;
        }

        // Initialize remove button visibility and disable options on page load
        updateRemoveButtonVisibility();
        disableSelectedEmployees();
        checkEmployeeSelects();
    });
</script>
