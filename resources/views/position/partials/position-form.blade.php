@php
    $isEdit = isset($position);
@endphp

<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
    <div class="flex flex-col mt-4 gap-6">
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="position_name" :value="__('Position Name')" />
                <x-text-input id="position_name" name="position_name" value="{{ old('position_name', $isEdit ? $position->position_name : '') }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('position_name')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-area id="description" name="description" type="text" class="mt-1 block w-full" >{{ old('description', $isEdit ? $position->description : '') }}</x-text-area>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </div>
</section>