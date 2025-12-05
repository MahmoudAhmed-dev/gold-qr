<x-layout>
    <x-slot:title>
        {{ __('bars.title') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gold mb-8">{{ __('bars.header') }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
            @foreach($bars as $bar)
                <div class="bg-surface p-6 rounded-lg border border-text-secondary shadow-md hover:shadow-lg transition-shadow duration-300 md:flex md:items-center md:justify-between">
                    <a href="{{ route('bars.show', [app()->getLocale(), $bar->id]) }}" class="font-source block">
                        <p class="text-lg font-semibold text-gold">{{ __('bars.code') }}: <span class="font-mono">{{ $bar->code }}</span></p>
                        <p class="text-text-secondary">{{ __('bars.serial_number') }}: {{ $bar->serial_number }}</p>
                        <p>{{ __('bars.material') }}: {{ app()->getLocale() == 'ar' ? $bar->material->name_ar : $bar->material->name_en }}</p>
                        <p>{{ __('bars.weight') }}: {{ $bar->weight }} {{ __('bars.gram') }}</p>
                        <p>{{ __('bars.fineness') }}: {{ $bar->fineness }}</p>
                    </a>
                    <canvas class="qrcode-canvas mx-auto md:m-0 mt-4" data-url="{{ route('bars.show', [app()->getLocale(), $bar->id]) }}"></canvas>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
