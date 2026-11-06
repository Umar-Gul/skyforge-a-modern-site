@php $sol = config('skyforge.solutions'); @endphp

<section id="solutions" class="relative bg-navy">

    {{-- Desktop: pinned, driven by scroll --}}
    <div class="hidden lg:block" data-sol-desktop>
        <div class="relative h-screen overflow-hidden" data-sol-pin>

            @foreach ($sol as $s)
                <img data-sol-img
                     src="{{ $s['image'] }}?auto=format&fit=crop&w=2400&q=80"
                     alt="{{ $s['title'] }}"
                     draggable="false"
                     class="absolute inset-0 h-full w-full object-cover"
                     loading="lazy" decoding="async">
            @endforeach

            <div class="absolute inset-0 bg-gradient-to-r from-navy/90 via-navy/45 to-navy/10"></div>

            <div class="relative mx-auto grid h-full max-w-[1440px] grid-cols-12 items-center gap-8 px-10">
                <div class="col-span-6">
                    <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Solutions</p>
                    <ul class="mt-8 space-y-3">
                        @foreach ($sol as $s)
                            <li class="sol-item flex items-baseline gap-5 font-display text-6xl font-bold uppercase leading-none xl:text-7xl" data-sol-item>
                                <span class="sol-num text-lg font-semibold tracking-[.2em] text-steel">0{{ $loop->iteration }}</span>
                                {{ $s['title'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="relative col-span-4 col-start-9 h-64">
                    @foreach ($sol as $s)
                        <div data-sol-text class="absolute inset-0">
                            <p class="text-xl leading-relaxed text-white/85">{{ $s['text'] }}</p>
                            <a href="#capabilities" class="mt-8 inline-block rounded-full border border-white/40 px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:border-signal hover:bg-signal">
                                Explore {{ $s['title'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Scroll progress line --}}
            <div class="absolute right-10 top-1/2 h-48 w-px -translate-y-1/2 bg-white/20">
                <div data-sol-progress class="h-full w-full origin-top scale-y-0 bg-signal"></div>
            </div>
        </div>
    </div>

    {{-- Mobile / tablet: simple stacked cards --}}
    <div class="px-6 py-20 lg:hidden" data-sol-mobile>
        <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal" data-reveal>Solutions</p>
        <h2 class="mt-4 font-display text-5xl font-bold uppercase leading-[.95]" data-reveal>Every mission,<br>covered.</h2>

        <div class="mt-12 space-y-6">
            @foreach ($sol as $s)
                <article data-reveal class="relative h-[420px] overflow-hidden rounded-2xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10">
                    <img src="{{ $s['image'] }}?auto=format&fit=crop&w=1000&q=75" alt="{{ $s['title'] }}" loading="lazy"
                         class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/50 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6">
                        <p class="text-xs font-semibold tracking-[.25em] text-signal">0{{ $loop->iteration }}</p>
                        <h3 class="mt-2 font-display text-4xl font-bold uppercase leading-none">{{ $s['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-white/80">{{ $s['text'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
