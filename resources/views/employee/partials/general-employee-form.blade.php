@php
    $isEdit = isset($employee);
@endphp

<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('General Information') }}
        </h2>
    </header>

    <div class="flex flex-col mt-4 gap-6">
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" value="{{ old('first_name', $isEdit ? $employee->first_name : '') }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" value="{{ old('last_name', $isEdit ? $employee->last_name : '') }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="nik" :value="__('NIK')" />
                <x-text-input id="nik" name="nik" type="number" value="{{ old('nik', $isEdit ? $employee->nik : '') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="birth_date" :value="__('Birth Date')" />
                <x-text-input id="birth_date" name="birth_date" value="{{ old('birth_date', $isEdit ? date('Y-m-d', strtotime($employee->birth_date)) : '') }}" type="date" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
            </div>
        </div>
    </div>
</section>