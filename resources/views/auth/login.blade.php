<x-layout>
    <x-slot:title>
        {{ __('auth.login') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="max-w-md mx-auto bg-surface p-8 rounded-lg shadow-md border border-gray-200">
            <h1 class="text-2xl font-bold text-gold mb-6 text-center">{{ __('auth.login') }}</h1>

            <form action="{{ route('login.store', app()->getLocale()) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-text-secondary mb-2">{{ __('auth.email') }}</label>
                    <input type="email" name="email" id="email" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-text-secondary mb-2">{{ __('auth.password_label') }}</label>
                    <input type="password" name="password" id="password" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" required>
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 flex items-center justify-between">
                    <label class="flex items-center text-text-secondary">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-gold focus:ring-gold">
                        <span class="mx-2">{{ __('auth.remember_me') }}</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-gold text-surface px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                    {{ __('auth.login') }}
                </button>

                {{-- <div class="mt-4 text-center">
                    <a href="{{ route('password.request', app()->getLocale()) }}" class="text-gold hover:underline text-sm">
                        {{ __('auth.forgot_password') }}
                    </a>
                </div> --}}
            </form>
        </div>
    </div>
</x-layout>
