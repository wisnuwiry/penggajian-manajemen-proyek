@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex gap-3 items-center text-sm font-medium leading-5 text-white bg-primary-500 rounded-lg px-4 py-2 w-full transition duration-150 ease-in-out'
            : 'flex gap-3 items-center text-sm font-medium leading-5 text-gray-700 hover:text-primary-500 hover:bg-primary-100 rounded-lg px-4 py-2 w-full transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
