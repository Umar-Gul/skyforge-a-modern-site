{{-- Featured image card used inside mega menus. Vars: $image, $eyebrow, $title, $href, $desc (optional)
     The data-preview-* hooks let the Aircraft menu swap this card while you hover its list. --}}
<a href="{{ $href ?? '#' }}" data-preview-card class="group relative block aspect-[16/10] overflow-hidden rounded-xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10 transition hover:ring-signal">
    <img data-preview-img src="{{ $image }}?auto=format&fit=crop&w=900&q=75" alt="{{ $title }}" loading="lazy"
         class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105">
    <div class="absolute inset-0 bg-gradient-to-t from-navy/95 via-navy/30 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 p-5">
        <p data-preview-eyebrow class="text-[11px] font-semibold uppercase tracking-[.25em] text-signal">{{ $eyebrow }}</p>
        <p data-preview-title class="mt-1 font-display text-3xl font-semibold uppercase leading-none">{{ $title }}</p>
        <p data-preview-desc class="mt-2 max-w-md text-[13px] leading-snug text-white/75 {{ empty($desc) ? 'hidden' : '' }}">{{ $desc ?? '' }}</p>
    </div>
</a>
