@extends('layouts.app')

@section('title', $aircraft['name'] . ' | Skyforge Aviation')
@section('description', $aircraft['name'] . ': ' . $aircraft['type'] . '. ' . \Illuminate\Support\Str::limit($details['summary'] ?? '', 120))

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => $aircraft['type'],
        'crumb'   => $aircraft['name'],
        'title'   => $aircraft['name'],
        'text'    => \Illuminate\Support\Str::limit($details['summary'] ?? '', 150),
        'image'   => $aircraft['image'],
    ])

    {{-- Key specs --}}
    <section class="border-y border-white/10 bg-navy-2">
        <dl class="mx-auto grid max-w-[1440px] grid-cols-2 gap-y-8 px-6 py-10 sm:grid-cols-3 lg:grid-cols-6 lg:px-10">
            @foreach (array_merge($aircraft['specs'], $details['more'] ?? []) as [$label, $value])
                <div data-reveal>
                    <dt class="text-[11px] uppercase tracking-[.22em] text-steel">{{ $label }}</dt>
                    <dd class="mt-2 font-display text-3xl font-semibold uppercase leading-none lg:text-4xl">{{ $value }}</dd>
                </div>
            @endforeach
        </dl>
    </section>

    {{-- Overview + features --}}
    <section class="bg-navy py-24 lg:py-32">
        <div class="mx-auto grid max-w-[1440px] gap-14 px-6 lg:grid-cols-12 lg:px-10">
            <div class="lg:col-span-6" data-reveal>
                <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Overview</p>
                <h2 class="mt-4 font-display text-5xl font-bold uppercase leading-[.95] lg:text-6xl">Designed around the mission.</h2>
                <p class="mt-8 text-lg leading-relaxed text-white/80">{{ $details['summary'] ?? '' }}</p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('contact', ['interest' => $aircraft['name']]) }}"
                       class="rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Request a quote</a>
                    <a href="{{ route('aircraft.index') }}"
                       class="rounded-full border border-white/40 px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:border-white hover:bg-white/10">All aircraft</a>
                </div>
            </div>

            <div class="lg:col-span-5 lg:col-start-8" data-reveal>
                <p class="menu-eyebrow">Key features</p>
                <ul class="mt-6 divide-y divide-white/10 border-y border-white/10">
                    @foreach ($details['features'] ?? [] as $f)
                        <li class="flex gap-4 py-5">
                            <svg class="mt-1 shrink-0 text-signal" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 5 5 9-10"/></svg>
                            <span class="text-[15px] leading-relaxed text-white/85">{{ $f }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Other aircraft --}}
    <section class="bg-navy pb-24 lg:pb-32">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-4xl font-bold uppercase leading-none lg:text-5xl">Explore more aircraft</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($others as $a)
                    @include('partials.aircraft-card', ['a' => $a])
                @endforeach
            </div>
        </div>
    </section>

    @include('sections.cta')
@endsection
