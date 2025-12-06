<x-layout>
    <div class="flex-grow flex flex-col items-center justify-center p-8 text-center min-h-[80vh]">
        <div class="mb-8">
            <!-- Placeholder Logo -->
            <svg class="w-32 h-32 text-gold mx-auto" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
            </svg>
        </div>
        <h1 class="text-5xl font-bold text-gold mb-4 font-source">{{ __('welcome.store_name') }}</h1>
        <p class="text-xl text-text-secondary mb-8 max-w-2xl">{{ __('welcome.description') }}</p>
        <a href="{{ route('search', app()->getLocale()) }}" class="bg-gold text-surface px-8 py-3 rounded-full text-lg font-semibold hover:bg-dark-gold transition-colors duration-300 shadow-lg">
            {{ __('welcome.certify_piece') }}
        </a>
    </div>
</x-layout>
