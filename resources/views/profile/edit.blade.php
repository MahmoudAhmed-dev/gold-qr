<x-layout>
    <x-slot:title>
        {{ __('profile.title') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="max-w-2xl mx-auto bg-surface p-8 rounded-lg shadow-md border border-gray-200">
            <h1 class="text-2xl font-bold text-gold mb-6">{{ __('profile.header') }}</h1>

            @if (session('status') === 'profile-updated')
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ __('profile.updated_success') }}
                </div>
            @endif

            <form action="{{ route('profile.update', app()->getLocale()) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ __('profile.personal_info') }}</h2>
                    
                    <div class="mb-4">
                        <label for="name" class="block text-text-secondary mb-2">{{ __('profile.name') }}</label>
                        <input type="text" name="name" id="name" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-text-secondary mb-2">{{ __('profile.email') }}</label>
                        <input type="email" name="email" id="email" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6 pt-6 border-t border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ __('profile.change_password') }}</h2>
                    <p class="text-sm text-gray-500 mb-4">{{ __('profile.password_note') }}</p>

                    <div class="mb-4">
                        <label for="current_password" class="block text-text-secondary mb-2">{{ __('profile.current_password') }}</label>
                        <input type="password" name="current_password" id="current_password" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-text-secondary mb-2">{{ __('profile.new_password') }}</label>
                        <input type="password" name="password" id="password" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-text-secondary mb-2">{{ __('profile.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-gold text-surface px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                        {{ __('profile.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
