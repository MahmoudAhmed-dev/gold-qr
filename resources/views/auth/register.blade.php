<x-layout>
    <x-slot:title>
        {{ __('auth.register') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="max-w-md mx-auto bg-surface p-8 rounded-lg shadow-md border border-gray-200">
            <h1 class="text-2xl font-bold text-gold mb-6 text-center">{{ __('auth.register') }}</h1>

            <form action="{{ route('register.store', app()->getLocale()) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-text-secondary mb-2">{{ __('auth.name') }}</label>
                    <input type="text" name="name" id="name" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-text-secondary mb-2">{{ __('auth.email') }}</label>
                    <input type="email" name="email" id="email" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-text-secondary mb-2">{{ __('auth.password_label') }}</label>
                    <input type="password" name="password" id="password" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-text-secondary mb-2">{{ __('auth.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" required>
                </div>

                <button type="submit" class="w-full bg-gold text-surface px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                    {{ __('auth.register') }}
                </button>

                <div class="mt-4 text-center">
                    <a href="{{ route('login', app()->getLocale()) }}" class="text-gold hover:underline text-sm">
                        {{ __('auth.already_have_account') }} {{ __('auth.login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
