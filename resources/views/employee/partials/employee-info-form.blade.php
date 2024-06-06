@php
    $isEdit = isset($employee);
@endphp

<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Employee Information') }}
        </h2>
    </header>

    <div class="flex flex-col mt-4 gap-6">
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="hire_date" :value="__('Hire Date')" />
                <x-text-input id="hire_date" name="hire_date" type="date" value="{{ old('hire_date', $isEdit ? date('Y-m-d', strtotime($employee->hire_date)) : '') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="department" :value="__('Department')" />
                <x-select-input id="department" name="department_id" value="{{ old('department_id', $isEdit ? $employee->department_id : '') }}">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $isEdit ? $employee->department_id : '') == $department->id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
            </div>
        </div>
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="position" :value="__('Position')"/>
                <x-select-input id="position" name="position_id" value="{{ old('position_id', $isEdit ? $employee->position_id : '') }}">
                <option value="">Select Position</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}" {{ old('position_id', $isEdit ? $employee->position_id : '') == $position->id ? 'selected' : '' }}>
                        {{ $position->position_name }}
                    </option>
                @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('position_id')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="salary" :value="__('Salary')" />
                <x-text-input id="salary" name="salary" value="{{ old('salary', $isEdit ? $employee->salary : '') }}" type="number" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="bank_name" :value="__('Bank Name')" />
                <x-text-input id="bank_name" name="bank_name" value="{{ old('bank_name', $isEdit ? $employee->bank_name : '') }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="bank_account_number" :value="__('Bank Account Number')" />
                <x-text-input id="bank_account_number" name="bank_account_number" value="{{ old('bank_account_number', $isEdit ? $employee->bank_account_number : '') }}" type="number" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2" />
            </div>
        </div>

    </div>
</section>

<script>
$(document).ready(function() {
    $('#department').select2({
        placeholder: 'Select Department',
        closeOnSelect: false
    });

    $('#position').select2({
        placeholder: 'Select Position',
        closeOnSelect: false
    });
});
</script>