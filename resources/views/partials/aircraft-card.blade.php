{{-- Aircraft card for grids. Var: $a (one entry from config('skyforge.aircraft')) --}}
<a href="{{ route('aircraft.show', $a['slug']) }}" data-reveal
   class="aircraft-card group relative block h-[520px] overflow-hidden rounded-2xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10 transition hover:ring-signal lg:h-[580px]">
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
