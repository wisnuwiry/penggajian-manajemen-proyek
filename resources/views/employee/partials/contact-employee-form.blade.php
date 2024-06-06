@php
    $isEdit = isset($employee);
@endphp

<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Contact') }}
        </h2>
    </header>

    <div class="flex flex-col mt-4 gap-6">
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="text" value="{{ old('email', $isEdit ? $employee->email : '') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input id="phone_number" name="phone_number" value="{{ old('phone_number', $isEdit ? $employee->phone_number : '') }}" type="tel" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-area id="address" name="address" type="text" class="mt-1 block w-full" >{{ old('address', $isEdit ? $employee->address : '') }}</x-text-area>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
    </div>
</section>