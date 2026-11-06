@php $slides = config('skyforge.hero_slides'); @endphp

<section id="hero" class="relative h-screen min-h-[640px] select-none overflow-hidden bg-navy" aria-roledescription="carousel" aria-label="Featured aircraft">

    @foreach ($slides as $i => $s)
        <article class="hero-slide absolute inset-0" data-slide aria-label="Slide {{ $loop->iteration }} of {{ count($slides) }}">

            {{-- Full-resolution photo (no blur, no heavy overlay) --}}
            <img data-slide-img
                 src="{{ $s['image'] }}?auto=format&fit=crop&w=1920&q=80"
                 srcset="{{ $s['image'] }}?auto=format&fit=crop&w=1280&q=80 1280w,
                         {{ $s['image'] }}?auto=format&fit=crop&w=1920&q=80 1920w,
                         {{ $s['image'] }}?auto=format&fit=crop&w=2560&q=85 2560w"
                 sizes="100vw"
                 alt="{{ $s['eyebrow'] }}"
                 draggable="false"
                 class="absolute inset-0 h-full w-full object-cover"
                 @if ($i === 0) fetchpriority="high" @endif
                 decoding="async">

            {{-- Background video: starts when this slide is active; the photo above shows until it plays (or if it cannot load) --}}
            @if (!empty($s['video']))
                <video data-slide-video class="hero-video absolute inset-0 h-full w-full object-cover"
                       muted loop playsinline preload="none" disablepictureinpicture tabindex="-1" aria-hidden="true"
                       poster="{{ $s['image'] }}?auto=format&fit=crop&w=1920&q=80">
                    @foreach ($s['video'] as $src)
                        <source src="{{ $src }}" type="video/mp4">
                    @endforeach
                </video>
            @endif

            {{-- Light scrims: left for text legibility, bottom for the controls --}}
            <div class="absolute inset-0 bg-gradient-to-r from-navy/70 via-navy/15 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-2/5 bg-gradient-to-t from-navy/90 to-transparent"></div>

            <div class="relative mx-auto flex h-full max-w-[1440px] items-end px-6 pb-44 lg:px-10 lg:pb-52">
                <div class="max-w-4xl">
                    <p class="s-anim mb-5 text-[13px] font-semibold uppercase tracking-[.3em] text-signal">{{ $s['eyebrow'] }}</p>
                    <h1 class="s-anim font-display text-6xl font-bold uppercase leading-[.92] sm:text-7xl lg:text-[8.5rem]">
                        {!! nl2br(e($s['title'])) !!}
                    </h1>
                    <p class="s-anim mt-7 max-w-xl text-lg leading-relaxed text-white/80">{{ $s['text'] }}</p>
                    <div class="s-anim mt-9">
                        <a href="{{ route($s['cta'][1], $s['cta'][2] ?? []) }}" class="inline-block rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">
                            {{ $s['cta'][0] }}
                        </a>
                    </div>
                </div>
            </div>
        </article>
    @endforeach

    {{-- Slider controls --}}
    <div class="absolute inset-x-0 bottom-0 z-10" data-hero-ui>
        <div class="mx-auto flex max-w-[1440px] items-end justify-between gap-8 px-6 pb-8 lg:px-10 lg:pb-10">

            <div class="grid max-w-[820px] flex-1 gap-3 sm:gap-5" style="grid-template-columns: repeat({{ count($slides) }}, minmax(0, 1fr));">
                @foreach ($slides as $i => $s)
                    <button type="button" class="hero-bar-btn" data-bar-btn="{{ $i }}" aria-label="Go to slide {{ $loop->iteration }}: {{ $s['label'] }}">
                        <span class="mb-3 hidden text-[11px] font-semibold uppercase tracking-[.22em] sm:block">{{ $s['label'] }}</span>
                        <span class="hero-bar block"><span class="hero-bar-fill block" data-bar-fill></span></span>
                    </button>
                @endforeach
            </div>

            <div class="flex items-center gap-5">
                <p class="hidden font-display text-xl font-semibold tracking-[.2em] lg:block">
                    <span data-current>01</span> <span class="text-white/40">/ {{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</span>
                </p>
                <div class="flex gap-3">
                    <button type="button" class="fleet-btn" data-pause aria-pressed="false" aria-label="Pause slideshow and video">
                        <svg class="i-pause" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="5" width="4" height="14" rx="1"/><rect x="14" y="5" width="4" height="14" rx="1"/></svg>
                        <svg class="i-play" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5.5v13a1 1 0 0 0 1.5.86l10.5-6.5a1 1 0 0 0 0-1.72L9.5 4.64A1 1 0 0 0 8 5.5Z"/></svg>
                    </button>
                    <button type="button" class="fleet-btn" data-prev aria-label="Previous slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5m6-6-6 6 6 6"/></svg>
                    </button>
                    <button type="button" class="fleet-btn" data-next aria-label="Next slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

