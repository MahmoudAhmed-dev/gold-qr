<x-layout>
    <x-slot:title>
        {{ __('auth.forgot_password') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="max-w-md mx-auto bg-surface p-8 rounded-lg shadow-md border border-gray-200">
            <h1 class="text-2xl font-bold text-gold mb-6 text-center">{{ __('auth.forgot_password') }}</h1>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <form action="{{ route('password.email', app()->getLocale()) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-text-secondary mb-2">{{ __('auth.email') }}</label>
                    <input type="email" name="email" id="email" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gold text-surface px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                    {{ __('auth.send_reset_link') }}
                </button>
            </form>
        </div>
    </div>
</x-layout>
