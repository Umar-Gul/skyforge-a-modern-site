<section id="aircraft" class="relative overflow-hidden bg-navy py-24 lg:py-32">
    <div class="mx-auto flex max-w-[1440px] flex-wrap items-end justify-between gap-8 px-6 lg:px-10">
        <div data-reveal>
            <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Our Aircraft</p>
            <h2 class="mt-4 max-w-2xl font-display text-5xl font-bold uppercase leading-[.95] lg:text-7xl">
                Built for<br>every mission.
            </h2>
        </div>
        <div class="flex items-center gap-3" data-reveal>
            <a href="{{ route('aircraft.index') }}" class="mr-3 hidden text-[13px] font-semibold uppercase tracking-[.14em] transition hover:text-signal sm:inline-block">View all aircraft →</a>
            <button id="fleet-prev" class="fleet-btn" aria-label="Previous aircraft">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5m6-6-6 6 6 6"/></svg>
            </button>
            <button id="fleet-next" class="fleet-btn" aria-label="Next aircraft">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </button>
        </div>
    </div>

    <div id="fleet-track" class="fleet-track mt-14 flex snap-x snap-mandatory gap-6 overflow-x-auto pb-4">
        @foreach (config('skyforge.aircraft') as $a)
            <a href="{{ route('aircraft.show', $a['slug']) }}" data-reveal
               class="aircraft-card group relative block h-[520px] w-[85vw] max-w-[440px] shrink-0 snap-start overflow-hidden rounded-2xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10 transition hover:ring-signal lg:h-[580px]">
                <img src="{{ $a['image'] }}?auto=format&fit=crop&w=1000&q=75" alt="{{ $a['name'] }}" loading="lazy"
                     class="absolute inset-0 h-full w-full object-cover transition duration-[1200ms] ease-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent"></div>

                <div class="absolute inset-x-0 bottom-0 p-7">
                    <p class="text-xs font-semibold uppercase tracking-[.25em] text-signal">{{ $a['type'] }}</p>
                    <h3 class="mt-2 font-display text-4xl font-bold uppercase leading-none lg:text-5xl">{{ $a['name'] }}</h3>

                    <dl class="mt-6 grid grid-cols-3 gap-3 border-t border-white/15 pt-4">
                        @foreach ($a['specs'] as [$label, $value])
                            <div>
                                <dt class="text-[11px] uppercase tracking-[.2em] text-steel">{{ $label }}</dt>
                                <dd class="mt-1 font-display text-xl font-semibold">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    <span class="mt-6 inline-flex items-center gap-2 text-[13px] font-semibold uppercase tracking-[.14em]">
                        Discover <span class="card-arrow">→</span>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</section>
