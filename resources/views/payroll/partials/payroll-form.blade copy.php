<form id="payroll-form" action="{{ isset($payroll) ? route('payroll.update', $payroll->id) : route('payroll.store') }}" method="POST">
    @csrf
    @if(isset($payroll))
    @method('PUT')
    @endif

    <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Employees') }}
            </h2>
        </header>
        <div id="employees-container">
            <div class="flex flex-col mt-4 gap-6 employee-entry border-t pt-4">
                <div class="flex flex-col md:flex-row flex-wrap gap-4">
                    <div class="flex-1">
                        <x-input-label for="employee_id" :value="__('Employee')" />
                        <x-select-input class="employee-select" name="employee_id[]">
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" data-salary="{{ $employee->salary }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('employee_id[]')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="basic_salary" :value="__('Basic Salary')" />
                        <input id="basic_salary" name="basic_salary[]" value="{{ old('basic_salary[]') }}" type="number" class="basic-salary border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" readonly required />
                        <x-input-error :messages="$errors->get('basic_salary[]')" class="mt-2" />
                    </div>
                </div>
                <div class="flex flex-col md:flex-row flex-wrap gap-4">
                    <div class="flex-1">
                        <x-input-label for="allowances" :value="__('Allowances')" />
                        <x-text-input class="allowances" name="allowances[]" value="{{ old('allowances[]', 0) }}" type="number" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('allowances[]')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="deductions" :value="__('Deductions')" />
                        <x-text-input class="deductions" name="deductions[]" value="{{ old('deductions[]', 0) }}" type="number" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('deductions[]')" class="mt-2" />
                    </div>
                </div>
                <div class="flex w-full justify-start">
                    <x-danger-button type="button" class="remove-employee">Delete</x-danger-button>
                </div>
            </div>
        </div>


        <hr class="mt-4">
        <div class="flex w-full justify-end py-4">
            <x-primary-button id="add-employee" type="button">Add Employee</x-primary-button>
        </div>
    </section>

    <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg fixed bottom-0 left-0 right-0">
        <div class="flex flex-col md:flex-row flex-wrap gap-4 max-w-7xl m-auto">
            <div class="flex-1">
                <x-input-label for="payroll_date" :value="__('Payroll Date')" />
                <input id="payroll_date" name="payroll_date" value="{{ old('payroll_date') }}" type="date" class="border-gray-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('payroll_date')" class="mt-2" />
            </div>
            <div class="flex-1 flex justify-end">
                <button class="inline-flex items-center px-12 py-2 bg-primary-500 border border-transparent rounded-lg font-semibold text-lg text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 transition ease-in-out duration-150">{{ isset($payroll) ? 'Update' : 'Save' }}</button>
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
        // Function to initialize Select2
        function initializeSelect2(element) {
            $(element).select2({
                placeholder: 'Select Employee',
                closeOnSelect: false
            });
        }

        // Initialize Select2 for first entry
        initializeSelect2('.employee-select');

        // Function to update salary based on selected employee
        function updateSalary(selectElement) {
            const salary = $(selectElement).find(':selected').data('salary');
            const basicSalaryInput = $(selectElement).closest('.employee-entry').find('.basic-salary');
            basicSalaryInput.val(salary);
            updateSummary();
        }

        // Function to update summary
        function updateSummary() {
            const summaryContainer = $('#summary-container');
            summaryContainer.empty();
            $('.employee-entry').each(function(index) {
                const employeeName = $(this).find('.employee-select option:checked').text();
                const basicSalary = $(this).find('.basic-salary').val();
                const allowances = $(this).find('.allowances').val();
                const deductions = $(this).find('.deductions').val();
                const netSalary = parseFloat(basicSalary) + parseFloat(allowances) - parseFloat(deductions);
                summaryContainer.append(`
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Karyawan ${index + 1}: ${employeeName}</h5>
                            <p class="card-text">Gaji Pokok: ${basicSalary}</p>
                            <p class="card-text">Tunjangan: ${allowances}</p>
                            <p class="card-text">Potongan: ${deductions}</p>
                            <p class="card-text">Gaji Bersih: ${netSalary}</p>
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

        // Add employee entry
        $('#add-employee').click(function() {
            const employeeEntry = $('.employee-entry').first().clone(true);
            const newId = Date.now(); // Generate unique ID
            employeeEntry.find('.employee-select').attr('id', `employee_id_${newId}`);
            employeeEntry.find('.basic-salary').attr('id', `basic_salary_${newId}`);
            employeeEntry.find('.allowances').attr('id', `allowances_${newId}`);
            employeeEntry.find('.deductions').attr('id', `deductions_${newId}`);
            employeeEntry.find('.employee-select').val('');
            employeeEntry.find('.basic-salary').val('');
            employeeEntry.find('.allowances').val(0);
            employeeEntry.find('.deductions').val(0);
            $('#employees-container').append(employeeEntry);
            initializeSelect2(`#employee_id_${newId}`);
            updateRemoveButtonVisibility();
        });

        // Remove employee entry
        $(document).on('click', '.remove-employee', function() {
            $(this).closest('.employee-entry').remove();
            updateSummary();
            updateRemoveButtonVisibility();
        });

        // Update salary and summary on employee selection
        $(document).on('change', '.employee-select', function() {
            updateSalary(this);
        });

        // Update summary on allowances or deductions input
        $(document).on('input', '.allowances, .deductions', function() {
            updateSummary();
        });

        // Initialize remove button visibility on page load
        updateRemoveButtonVisibility();
    });
</script>