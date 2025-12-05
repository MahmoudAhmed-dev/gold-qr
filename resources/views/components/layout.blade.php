<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? __('welcome.store_name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-background text-text-primary font-sans flex flex-col min-h-screen">
    <header class="bg-surface shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home', app()->getLocale()) }}" class="text-2xl font-bold text-gold font-source flex items-center gap-2">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
                </svg>
                {{ __('welcome.store_name') }}
            </a>
            <nav class="flex gap-6">
                <a href="{{ route('home', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.home') }}</a>
                <a href="{{ route('search', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.search') }}</a>
                <a href="{{ route('bars.index', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.bars') }}</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-surface mt-auto py-6 border-t border-gray-200">
        <div class="container mx-auto px-4 text-center text-text-secondary text-sm">
            &copy; {{ date('Y') }} {{ __('welcome.store_name') }}. All rights reserved.
        </div>
    </footer>
    @vite('resources/js/app.js')
</body>
</html>
