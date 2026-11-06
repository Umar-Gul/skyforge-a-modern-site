<section id="capabilities" class="bg-navy-2 py-24 lg:py-32">
    <div class="mx-auto max-w-[1440px] px-6 lg:px-10">

        <div data-reveal class="max-w-3xl">
            <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Capabilities</p>
            <h2 class="mt-4 font-display text-5xl font-bold uppercase leading-[.95] lg:text-7xl">
                The technology<br>behind the flight.
            </h2>
        </div>

        <div class="mt-16 grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Autonomy & Avionics', 'Fly-by-wire controls and sensor fusion that reduce pilot workload and open the door to uncrewed missions.',
                    '<rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/>'],
                ['Hybrid-Electric Power', 'Propulsion architectures that cut fuel burn, noise and emissions without giving up range.',
                    '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8Z"/>'],
                ['Advanced Composites', 'Lightweight airframes built from next-generation materials for strength, efficiency and long service life.',
                    '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>'],
                ['Global Lifecycle Support', 'Spares, maintenance and training networks that keep every aircraft mission-ready, wherever it flies.',
                    '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18"/>'],
            ] as [$title, $text, $icon])
                <article data-reveal class="cap-card pt-8">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icon !!}</svg>
                    <h3 class="mt-6 font-display text-3xl font-semibold uppercase leading-none">{{ $title }}</h3>
                    <p class="mt-4 text-[15px] leading-relaxed text-steel">{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
