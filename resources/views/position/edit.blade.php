<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Edit Position') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" action="{{ route('position.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('position.partials.position-form')
            @include('position.partials.action-position-form')
        </form>
    </div>
</x-app-layout>