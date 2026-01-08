<x-layout>
    <x-slot:title>
        {{ __('bars.bar_details') }}
    </x-slot>

    <div class="container mx-auto p-8">
        <a href="{{ route('search', app()->getLocale()) }}" class="text-gold hover:underline mb-8 block">{{ __('bars.back_to_search') }}</a>
        <h1 class="text-3xl font-bold text-gold mb-8">{{ __('bars.bar_details') }}</h1>
        <div id="bar-card" class="bg-surface text-text-primary p-6 rounded-lg border border-text-secondary shadow-md max-w-md mx-auto md:flex md:items-center md:justify-between">
            <div class="font-source">
                <p class="text-lg font-semibold text-gold">{{ __('bars.code') }}: <span class="font-mono">{{ $bar->code }}</span></p>
                <p class="text-text-secondary">{{ __('bars.serial_number') }}: {{ $bar->serial_number }}</p>
                <p>{{ __('bars.material') }}: {{ app()->getLocale() == 'ar' ? $bar->material->name_ar : $bar->material->name_en }}</p>
                <p>{{ __('bars.weight') }}: {{ $bar->weight }} {{ __('bars.gram') }}</p>
                <p>{{ __('bars.fineness') }}: {{ $bar->fineness }}</p>
            </div>
            <canvas id="qrcode" class="mx-auto md:m-0 mt-4"></canvas>
        </div>

        <div class="mt-8 text-center">
             <button id="download-btn" class="bg-gold text-surface px-6 py-2 rounded-lg font-semibold hover:bg-opacity-90 transition-colors cursor-pointer">
                {{ __('bars.download_image') }}
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.getElementById('download-btn').addEventListener('click', function() {
            const original = document.getElementById('bar-card');
            const clone = original.cloneNode(true);

            // Configure clone styles for fixed desktop-like appearance
            clone.style.position = 'absolute';
            clone.style.left = '-9999px';
            clone.style.top = '0';
            clone.style.width = '400px'; // Fixed width for consistent card size
            clone.style.maxWidth = 'none';
            
            // Force flex layout (desktop view) to ensure consistent look regardless of screen size
            clone.classList.remove('md:flex', 'md:items-center', 'md:justify-between', 'max-w-md', 'mx-auto', 'border', 'border-text-secondary', 'shadow-md');
            clone.classList.add('flex', 'items-center', 'justify-between');

            // Handle Canvas (QR Code) - Canvas content is not copied by cloneNode
            const originalCanvas = original.querySelector('canvas');
            const cloneCanvas = clone.querySelector('canvas');
            
            if (originalCanvas && cloneCanvas) {
                cloneCanvas.width = originalCanvas.width;
                cloneCanvas.height = originalCanvas.height;
                
                const ctx = cloneCanvas.getContext('2d');
                ctx.drawImage(originalCanvas, 0, 0);
                
                // Adjust margin classes for desktop layout on the clone
                cloneCanvas.classList.remove('mx-auto', 'md:m-0');
                cloneCanvas.classList.add('m-0');
            }

            document.body.appendChild(clone);

            const config = {
                backgroundColor: '#ffffff',
                scale: 2, // High resolution
                width: 400,
                windowWidth: 1200 
            };

            html2canvas(clone, config).then(canvas => {
                const link = document.createElement('a');
                link.download = 'bar-card-{{ $bar->code }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                
                document.body.removeChild(clone);
            }).catch(err => {
                console.error('Download failed:', err);
                if (document.body.contains(clone)) {
                    document.body.removeChild(clone);
                }
            });
        });
    </script>
</x-layout>
