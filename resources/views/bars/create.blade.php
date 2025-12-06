<x-layout>
    <x-slot:title>
        {{ __('bars.create_new') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gold mb-8">{{ __('bars.create_new') }}</h1>

        <div class="bg-surface p-8 rounded-lg shadow-md max-w-2xl mx-auto border border-gray-200">
            <form action="{{ route('bars.store', app()->getLocale()) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="code" class="block text-text-secondary mb-2">{{ __('bars.code') }}</label>
                    <input type="text" name="code" id="code" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('code') }}" required>
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="serial_number" class="block text-text-secondary mb-2">{{ __('bars.serial_number') }}</label>
                    <input type="text" name="serial_number" id="serial_number" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('serial_number') }}" required>
                    @error('serial_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="material_id" class="block text-text-secondary mb-2">{{ __('bars.material') }}</label>
                    <select name="material_id" id="material_id" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" required>
                        <option value="">{{ __('bars.select_material') }}</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'ar' ? $material->name_ar : $material->name_en }}
                            </option>
                        @endforeach
                    </select>
                    @error('material_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="weight" class="block text-text-secondary mb-2">{{ __('bars.weight') }} ({{ __('bars.gram') }})</label>
                    <input type="number" step="0.01" name="weight" id="weight" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('weight') }}" required>
                    @error('weight')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="fineness" class="block text-text-secondary mb-2">{{ __('bars.fineness') }}</label>
                    <input type="number" step="0.01" name="fineness" id="fineness" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:border-gold" value="{{ old('fineness') }}" required>
                    @error('fineness')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('bars.index', app()->getLocale()) }}" class="px-6 py-3 rounded-lg border border-gray-300 text-text-secondary hover:bg-gray-50 transition-colors">
                        {{ __('bars.cancel') }}
                    </a>
                    <button type="submit" class="bg-gold text-surface px-6 py-3 rounded-lg font-semibold hover:bg-dark-gold transition-colors">
                        {{ __('bars.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
