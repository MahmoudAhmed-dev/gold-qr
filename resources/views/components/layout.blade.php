<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? __('welcome.store_name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-background text-text-primary font-sans flex flex-col min-h-screen">
    <header class="bg-surface shadow-md relative">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4 justify-between w-full">
                <button id="mobile-menu-btn" class="md:hidden text-text-primary hover:text-gold focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('home', app()->getLocale()) }}" class="text-2xl font-bold text-gold font-source flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                    {{ __('welcome.store_name') }}
                </a>
            </div>

            <nav class="hidden md:flex gap-6 items-center text-nowrap">
                <a href="{{ route('home', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.home') }}</a>
                <a href="{{ route('search', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.search') }}</a>
                
                @auth
                    <a href="{{ route('bars.index', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.dashboard') }}</a>
                    <a href="{{ route('profile.edit', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors">{{ __('nav.profile') }}</a>
                    <form action="{{ route('logout', app()->getLocale()) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-text-primary hover:text-gold transition-colors border border-black px-4 py-2 rounded">{{ __('auth.logout') }}</button>
                    </form>
                @else
                    <a href="{{ route('login', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors border border-black px-4 py-2 rounded">{{ __('auth.login') }}</a>
                @endauth

                @if(Route::currentRouteName())
                    <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => app()->getLocale() == 'ar' ? 'en' : 'ar'])) }}" class="text-gold font-bold border border-gold px-2 py-1 rounded hover:bg-gold hover:text-surface transition-colors text-sm">
                        {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
                    </a>
                @endif
            </nav>
        </div>

        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity" id="sidebar-backdrop"></div>
            <div class="absolute inset-y-0 left-0 w-64 bg-surface shadow-lg transform transition-transform duration-300 ease-in-out rtl:left-auto rtl:right-0" id="sidebar-content">
                <div class="p-4 border-b flex justify-between items-center">
                    <span class="text-xl font-bold text-gold">{{ __('welcome.store_name') }}</span>
                    <button id="close-sidebar-btn" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="p-4 flex flex-col gap-4">
                    <a href="{{ route('home', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors block py-2">{{ __('nav.home') }}</a>
                    <a href="{{ route('search', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors block py-2">{{ __('nav.search') }}</a>
                    
                    @auth
                        <a href="{{ route('bars.index', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors block py-2">{{ __('nav.dashboard') }}</a>
                        <a href="{{ route('profile.edit', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors block py-2">{{ __('nav.profile') }}</a>
                        <form action="{{ route('logout', app()->getLocale()) }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="text-text-primary hover:text-gold transition-colors w-full py-2 border border-black rounded">{{ __('auth.logout') }}</button>
                        </form>
                    @else
                        <a href="{{ route('login', app()->getLocale()) }}" class="text-text-primary hover:text-gold transition-colors block py-2 border border-black rounded text-center">{{ __('auth.login') }}</a>
                    @endauth

                    @if(Route::currentRouteName())
                        <div class="pt-4 border-t">
                            <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => app()->getLocale() == 'ar' ? 'en' : 'ar'])) }}" class="inline-block text-gold font-bold border border-gold px-4 py-2 rounded hover:bg-gold hover:text-surface transition-colors text-sm">
                                {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
                            </a>
                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <main class="grow">
        {{ $slot }}
    </main>

    <footer class="bg-surface mt-auto py-6 border-t border-gray-200">
        <div class="container mx-auto px-4 text-center text-text-secondary text-sm">
            &copy; {{ date('Y') }} {{ __('welcome.store_name') }}. All rights reserved.
        </div>
    </footer>
    @vite('resources/js/app.js')
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const closeSidebarBtn = document.getElementById('close-sidebar-btn');
        const sidebarBackdrop = document.getElementById('sidebar-backdrop');

        function toggleSidebar() {
            mobileSidebar.classList.toggle('hidden');
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', toggleSidebar);
        }

        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', toggleSidebar);
        }

        if (sidebarBackdrop) {
            sidebarBackdrop.addEventListener('click', toggleSidebar);
        }
    </script>
</body>
</html>
