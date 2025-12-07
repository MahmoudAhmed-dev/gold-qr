<x-layout>
    <x-slot:title>
        {{ __('errors.server_error') }}
    </x-slot>

    <div class="grow flex flex-col items-center justify-center p-8 text-center min-h-[60vh]">
        <h1 class="text-6xl font-bold text-gold mb-4">500</h1>
        <h2 class="text-2xl font-semibold text-text-primary mb-4">{{ __('errors.server_error') }}</h2>
        <p class="text-text-secondary mb-8 max-w-md">{{ __('errors.server_error_desc') }}</p>
        <a href="{{ route('home', app()->getLocale()) }}" class="bg-gold text-surface px-6 py-3 rounded-full font-semibold hover:bg-dark-gold transition-colors shadow-md">
            {{ __('errors.go_home') }}
        </a>
    </div>
</x-layout>
