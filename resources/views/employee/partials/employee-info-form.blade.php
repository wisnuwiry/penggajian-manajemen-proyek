<section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Employee Information') }}
        </h2>
    </header>

    <div class="flex flex-col mt-4 gap-6">
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="hire_date" :value="__('Hire Date')" />
                <x-text-input id="hire_date" name="hire_date" type="date" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="department" :value="__('Department')" />
                <x-select-input id="department" name="department">
                </x-select-input>
                <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
            </div>
        </div>
        <div class="flex flex-col md:flex-row flex-wrap gap-4">
            <div class="flex-1">
                <x-input-label for="position" :value="__('Position')"/>
                <x-select-input id="position" name="position">
                </x-select-input>
                <x-input-error :messages="$errors->get('position_id')" class="mt-2" />
            </div>
            <div class="hidden md:block flex-1"></div>
        </div>

    </div>
</section>

<script>
$('#department').select2({
    placeholder: 'Select Department',
    ajax: {
        url: '/api/departments',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            console.log(data);
            return {
            results:  $.map(data, function (item) {
                    return {
                        text: item.department_name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

$('#position').select2({
    placeholder: 'Select Position',
    ajax: {
        url: '/api/positions',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            console.log(data);
            return {
            results:  $.map(data, function (item) {
                    return {
                        text: item.position_name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});
</script>