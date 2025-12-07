<x-layout>
    <x-slot:title>
        {{ __('bars.title') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gold">{{ __('bars.header') }}</h1>
            @auth
                <a href="{{ route('bars.create', app()->getLocale()) }}" class="bg-gold text-surface px-4 py-2 rounded hover:bg-yellow-600 transition-colors">
                    {{ __('bars.create_new') }}
                </a>
            @endauth
        </div>

        <div class="mb-6">
            <form action="{{ route('bars.index', app()->getLocale()) }}" method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="{{ __('bars.search_placeholder') }}" value="{{ request('search') }}" class="w-full bg-surface p-2 rounded border border-gray-300 focus:outline-none focus:border-gold">
                <button type="submit" class="bg-gold text-surface px-4 py-2 rounded hover:bg-dark-gold transition-colors">
                    {{ __('bars.search') }}
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
            @foreach($bars as $bar)
                <div class="bg-surface p-6 rounded-lg border border-text-secondary shadow-md hover:shadow-lg transition-shadow duration-300 md:flex md:items-center md:justify-between">
                    <div class="grow">
                        <a href="{{ route('bars.show', [app()->getLocale(), $bar->identifier]) }}" class="font-source block">
                            <p class="text-lg font-semibold text-gold">{{ __('bars.code') }}: <span class="font-mono">{{ $bar->code }}</span></p>
                            <p class="text-text-secondary">{{ __('bars.serial_number') }}: {{ $bar->serial_number }}</p>
                            <p>{{ __('bars.material') }}: {{ app()->getLocale() == 'ar' ? $bar->material->name_ar : $bar->material->name_en }}</p>
                            <p>{{ __('bars.weight') }}: {{ $bar->weight }} {{ __('bars.gram') }}</p>
                            <p>{{ __('bars.fineness') }}: {{ $bar->fineness }}</p>
                        </a>
                        
                        <div class="md:hidden my-4 flex justify-center">
                            <canvas class="qrcode-canvas" data-url="{{ route('bars.show', [app()->getLocale(), $bar->identifier]) }}"></canvas>
                        </div>

                        @auth
                            <div class="mt-4 flex flex-wrap gap-4">
                                <button type="button" class="flex-1 lg:flex-none bg-gold text-surface px-4 py-2 rounded hover:bg-dark-gold transition-colors download-qr-btn flex items-center justify-center" 
                                    data-filename="QR-{{ $bar->code }}-{{ $bar->serial_number }}"
                                    data-code="{{ $bar->code }}"
                                    data-serial="{{ $bar->serial_number }}"
                                >
                                    {{ __('bars.download_qr') }}
                                </button>
                                <a href="{{ route('bars.edit', [app()->getLocale(), $bar->id]) }}" class="flex-1 lg:flex-none bg-gold text-surface px-4 py-2 rounded hover:bg-dark-gold transition-colors flex items-center justify-center">
                                    {{ __('bars.edit') }}
                                </a>
                                <form action="{{ route('bars.destroy', [app()->getLocale(), $bar->id]) }}" method="POST" class="flex-1 lg:flex-none flex" onsubmit="return confirm('{{ __('bars.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gold text-surface px-4 py-2 rounded hover:bg-dark-gold transition-colors w-full h-full flex items-center justify-center">
                                        {{ __('bars.delete') }}
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                    <div class="hidden md:block ml-4 rtl:mr-4 rtl:ml-0">
                        <canvas class="qrcode-canvas" data-url="{{ route('bars.show', [app()->getLocale(), $bar->identifier]) }}"></canvas>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $bars->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</x-layout>
