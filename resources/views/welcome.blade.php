<x-layout>
    <div class="flex-grow flex flex-col items-center justify-center p-8 text-center min-h-[80vh]">
        <div class="mb-8">
            <!-- Logo -->
            <img src="{{ asset('logo.png') }}" alt="{{ __('welcome.store_name') }}" class="size-48 mx-auto object-contain">
        </div>
        <h1 class="text-5xl font-bold text-gold mb-4 font-source">{{ __('welcome.store_name') }}</h1>
        <p class="text-xl text-text-secondary mb-8 max-w-2xl">{{ __('welcome.description') }}</p>
        <a href="{{ route('search', app()->getLocale()) }}" class="bg-gold text-surface px-8 py-3 rounded-full text-lg font-semibold hover:bg-dark-gold transition-colors duration-300 shadow-lg">
            {{ __('welcome.certify_piece') }}
        </a>
    </div>
</x-layout>
