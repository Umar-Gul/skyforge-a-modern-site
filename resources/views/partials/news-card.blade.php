{{-- News card for grids. Var: $n (one entry from config('skyforge.news')) --}}
<a href="{{ route('news.show', $n['slug']) }}" data-reveal data-filter-item data-tag="{{ $n['category'] }}" @if (!empty($hidden)) hidden @endif
   class="group flex flex-col overflow-hidden rounded-2xl bg-navy-2 ring-1 ring-white/10 transition hover:ring-signal">
    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-navy-2 to-[#1b2c4d]">
        <img src="{{ $n['image'] }}?auto=format&fit=crop&w=900&q=75" alt="" loading="lazy"
             class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105">
    </div>
    <div class="flex flex-1 flex-col p-6">
        <p class="text-[11px] font-semibold uppercase tracking-[.25em] text-signal">{{ $n['tag'] }} <span class="text-steel">&middot; {{ $n['date'] }}</span></p>
        <h3 class="mt-3 font-display text-3xl font-semibold uppercase leading-[1.02]">{{ $n['title'] }}</h3>
        <p class="mt-3 flex-1 text-[15px] leading-relaxed text-white/70">{{ $n['excerpt'] }}</p>
        <span class="mt-5 inline-flex items-center gap-2 text-[13px] font-semibold uppercase tracking-[.14em]">Read story <span class="card-arrow">→</span></span>
    </div>
</a>
