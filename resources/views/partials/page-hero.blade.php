{{-- Inner-page hero. Vars: $eyebrow, $title (use \n for a line break), $text (optional), $image (optional Unsplash base URL) --}}
<section class="relative overflow-hidden bg-navy pb-16 pt-40 lg:pb-24 lg:pt-52">
    @if (!empty($image))
        <img src="{{ $image }}?auto=format&fit=crop&w=2400&q=80" alt="" aria-hidden="true"
             class="absolute inset-0 h-full w-full object-cover opacity-45">
    @endif
    <div class="absolute inset-0 bg-gradient-to-b from-navy/70 via-navy/60 to-navy"></div>

    <div class="relative mx-auto max-w-[1440px] px-6 lg:px-10">
        <nav aria-label="Breadcrumb" class="text-[12px] font-medium uppercase tracking-[.2em] text-steel">
            <a href="{{ route('home') }}" class="transition hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <span class="text-white/80">{{ $crumb ?? $eyebrow }}</span>
        </nav>
        <p data-reveal class="mt-8 text-[13px] font-semibold uppercase tracking-[.3em] text-signal">{{ $eyebrow }}</p>
        <h1 data-reveal class="mt-5 max-w-5xl font-display font-bold uppercase leading-[.92] {{ mb_strlen($title) > 32 ? 'text-5xl sm:text-6xl lg:text-7xl' : 'text-6xl sm:text-7xl lg:text-[7.5rem]' }}">{!! nl2br(e($title)) !!}</h1>
        @if (!empty($text))
            <p data-reveal class="mt-8 max-w-2xl text-lg leading-relaxed text-white/80">{{ $text }}</p>
        @endif
    </div>
</section>
