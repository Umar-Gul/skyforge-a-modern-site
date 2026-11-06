@php
    $news = array_slice(config('skyforge.news'), 0, 4);
    $feat = $news[0];
    $rest = array_slice($news, 1);
@endphp

<section id="news" class="bg-navy py-24 lg:py-32">
    <div class="mx-auto max-w-[1440px] px-6 lg:px-10">

        <div data-reveal class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Newsroom</p>
                <h2 class="mt-4 font-display text-5xl font-bold uppercase leading-[.95] lg:text-7xl">Latest stories.</h2>
            </div>
            <a href="{{ route('news.index') }}" class="group inline-flex items-center gap-2 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:text-signal">
                View all news <span class="card-arrow">→</span>
            </a>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-12">

            {{-- Featured story --}}
            <a href="{{ route('news.show', $feat['slug']) }}" data-reveal
               class="group relative block min-h-[440px] overflow-hidden rounded-2xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10 transition hover:ring-signal lg:col-span-7 lg:min-h-[620px]">
                <img src="{{ $feat['image'] }}?auto=format&fit=crop&w=1400&q=80" alt="{{ $feat['title'] }}" loading="lazy"
                     class="absolute inset-0 h-full w-full object-cover transition duration-[1200ms] ease-out group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-7 lg:p-10">
                    <p class="text-xs font-semibold uppercase tracking-[.25em] text-signal">{{ $feat['tag'] }} <span class="text-white/50">&middot; {{ $feat['date'] }}</span></p>
                    <h3 class="mt-3 max-w-2xl font-display text-4xl font-bold uppercase leading-[1] lg:text-6xl">{{ $feat['title'] }}</h3>
                    <p class="mt-4 max-w-xl text-[15px] leading-relaxed text-white/75">{{ $feat['excerpt'] }}</p>
                    <span class="mt-6 inline-flex items-center gap-2 text-[13px] font-semibold uppercase tracking-[.14em]">Read story <span class="card-arrow">→</span></span>
                </div>
            </a>

            {{-- Smaller stories --}}
            <div class="flex flex-col gap-6 lg:col-span-5">
                @foreach ($rest as $n)
                    <a href="{{ route('news.show', $n['slug']) }}" data-reveal
                       class="group flex min-h-[150px] flex-1 overflow-hidden rounded-2xl bg-navy-2 ring-1 ring-white/10 transition hover:ring-signal">
                        <div class="relative w-2/5 shrink-0 overflow-hidden bg-gradient-to-br from-navy-2 to-[#1b2c4d]">
                            <img src="{{ $n['image'] }}?auto=format&fit=crop&w=700&q=75" alt="{{ $n['title'] }}" loading="lazy"
                                 class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        </div>
                        <div class="flex flex-col justify-center gap-3 p-5 lg:p-6">
                            <p class="text-[11px] font-semibold uppercase tracking-[.25em] text-signal">{{ $n['tag'] }} <span class="text-steel">&middot; {{ $n['date'] }}</span></p>
                            <h3 class="font-display text-2xl font-semibold uppercase leading-[1.05] lg:text-3xl">{{ $n['title'] }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
