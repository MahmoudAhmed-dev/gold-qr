<x-layout>
    <x-slot:title>
        {{ __('bars.bar_details') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <a href="{{ route('search', app()->getLocale()) }}" class="text-gold hover:underline mb-8 block">{{ __('bars.back_to_search') }}</a>
        <h1 class="text-3xl font-bold text-gold mb-8">{{ __('bars.bar_details') }}</h1>
        <div class="bg-surface text-text-primary p-6 rounded-lg border border-text-secondary shadow-md max-w-md mx-auto md:flex md:items-center md:justify-between">
            <div class="font-source">
                <p class="text-lg font-semibold text-gold">{{ __('bars.code') }}: <span class="font-mono">{{ $bar->code }}</span></p>
                <p class="text-text-secondary">{{ __('bars.serial_number') }}: {{ $bar->serial_number }}</p>
                <p>{{ __('bars.material') }}: {{ app()->getLocale() == 'ar' ? $bar->material->name_ar : $bar->material->name_en }}</p>
                <p>{{ __('bars.weight') }}: {{ $bar->weight }} {{ __('bars.gram') }}</p>
                <p>{{ __('bars.fineness') }}: {{ $bar->fineness }}</p>
            </div>
            <canvas id="qrcode" class="mx-auto md:m-0 mt-4"></canvas>
        </div>
    </div>
</x-layout>
