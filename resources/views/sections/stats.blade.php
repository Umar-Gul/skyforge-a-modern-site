<section class="border-y border-white/10 bg-navy-2">
    <div class="mx-auto grid max-w-[1440px] grid-cols-2 gap-x-6 gap-y-12 px-6 py-16 lg:grid-cols-4 lg:px-10 lg:py-20">
        @foreach ([
            [1200, 0, '+', 'Aircraft delivered'],
            [64, 0, '', 'Countries served'],
            [5, 0, 'M+', 'Flight hours logged'],
            [98.7, 1, '%', 'Mission readiness'],
        ] as [$value, $decimals, $suffix, $label])
            <div data-reveal class="lg:border-l lg:border-white/10 lg:pl-8 lg:first:border-l-0 lg:first:pl-0">
                <p class="font-display text-6xl font-bold leading-none lg:text-7xl">
                    <span data-count="{{ $value }}" data-decimals="{{ $decimals }}">{{ number_format($value, $decimals) }}</span><span class="text-signal">{{ $suffix }}</span>
                </p>
                <p class="mt-3 text-[13px] uppercase tracking-[.2em] text-steel">{{ $label }}</p>
            </div>
        @endforeach
    </div>
</section>
