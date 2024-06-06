@php
    $isEdit = isset($department);
@endphp

<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
    <div class="flex flex-col mt-4 gap-6">
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="department_name" :value="__('Department Name')" />
                <x-text-input id="department_name" name="department_name" value="{{ old('department_name', $isEdit ? $department->department_name : '') }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="manager" :value="__('Manager')" />
                <x-select-input id="manager" name="manager_id" value="{{ old('manager_id', $isEdit ? $department->manager_id : '') }}">
                <option value="">Select Manager</option>

                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}" {{ old('manager_id', $isEdit ? $department->manager_id : '') == $manager->id ? 'selected' : '' }}>
                        {{ $manager->first_name }} {{ $manager->last_name }}
                    </option>
                @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('manager_id')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-area id="description" name="description" type="text" class="mt-1 block w-full" >{{ old('description', $isEdit ? $department->description : '') }}</x-text-area>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#manager').select2({
        placeholder: 'Select Manager',
        closeOnSelect: false
    });
});
</script>