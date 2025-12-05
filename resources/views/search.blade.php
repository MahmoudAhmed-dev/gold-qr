<x-layout>
    <x-slot:title>
        {{ __('nav.search') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gold mb-8">{{ __('nav.search') }}</h1>
        
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('bars.index', app()->getLocale()) }}" method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="{{ __('nav.search') }}..." class="flex-grow p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold">
                <button type="submit" class="bg-gold text-white px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                    {{ __('nav.search') }}
                </button>
            </form>
        </div>
    </div>
</x-layout>
