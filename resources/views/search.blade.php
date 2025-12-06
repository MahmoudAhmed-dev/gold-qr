<x-layout>
    <x-slot:title>
        {{ __('nav.search') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gold mb-8">{{ __('nav.search') }}</h1>
        
        <div class="max-w-2xl mx-auto bg-surface p-8 rounded-lg shadow-md border border-gray-200">
            @if(session('error'))
                <div class="bg-surface border border-error text-error px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('search.find', app()->getLocale()) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="code" class="block text-text-secondary mb-2">{{ __('bars.code') }}</label>
                    <input type="text" name="code" id="code" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('code') }}" required>
                </div>

                <div class="mb-6">
                    <label for="serial_number" class="block text-text-secondary mb-2">{{ __('bars.serial_number') }}</label>
                    <input type="text" name="serial_number" id="serial_number" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('serial_number') }}" required>
                </div>

                <button type="submit" class="w-full bg-gold text-surface px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                    {{ __('nav.search') }}
                </button>
            </form>
        </div>
    </div>
</x-layout>
