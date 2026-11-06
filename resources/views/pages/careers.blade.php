@extends('layouts.app')

@section('title', 'Careers | Skyforge Aviation')
@section('description', 'Build the aircraft that move the world forward. Explore open roles, early careers and benefits at Skyforge Aviation.')

@php
    $areas = ['Engineering', 'Manufacturing', 'Flight operations', 'Business & finance'];
    $active = $area ? \Illuminate\Support\Str::slug($area) : 'all';

    $roles = config('skyforge.roles');

    $life = [
        ['Work that matters', 'Your work ends up in aircraft that rescue people, connect communities and move help where it is needed.'],
        ['Learn from the best', 'Work next to test pilots, structures experts and software engineers, with a mentor from day one.'],
        ['Build to last', 'We invest in long programs and long careers, with clear paths from specialist to leader.'],
    ];
    $benefits = ['Health, dental and vision coverage', 'Retirement plan with company match', 'Generous paid leave and flexible schedules', 'Tuition and certification support', 'Relocation assistance', 'Employee flight days'];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Careers',
        'title'   => "Soar to\nnew heights.",
        'text'    => 'Calling fearless innovators, leaders and problem solvers to help build the next generation of flight.',
        'image'   => config('skyforge.hero_slides')[3]['image'],
    ])

    {{-- Life at Skyforge --}}
    <section id="life" class="bg-navy py-20 lg:py-24">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">Life at Skyforge</h2>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ($life as $i => [$title, $text])
                    <div data-reveal class="cap-card pt-6">
                        <p class="font-display text-xl font-semibold text-signal">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-3 font-display text-3xl font-semibold uppercase leading-none">{{ $title }}</h3>
                        <p class="mt-4 text-[15px] leading-relaxed text-white/70">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Open roles --}}
    <section id="roles" class="border-y border-white/10 bg-navy-2 py-20 lg:py-24">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10" data-filter-group>
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">Open roles</h2>

            <div class="mt-8 flex flex-wrap gap-3" role="group" aria-label="Filter roles by area">
                <button type="button" class="chip {{ $active === 'all' ? 'is-active' : '' }}" data-filter="all">All</button>
                @foreach ($areas as $a)
                    <button type="button" class="chip {{ $active === \Illuminate\Support\Str::slug($a) ? 'is-active' : '' }}" data-filter="{{ \Illuminate\Support\Str::slug($a) }}">{{ $a }}</button>
                @endforeach
            </div>

            <ul class="mt-10 divide-y divide-white/10 border-y border-white/10">
                @foreach ($roles as [$title, $areaName, $place, $type])
                    <li data-filter-item data-tag="{{ \Illuminate\Support\Str::slug($areaName) }}" @if ($active !== 'all' && $active !== \Illuminate\Support\Str::slug($areaName)) hidden @endif
                        class="flex flex-wrap items-center justify-between gap-4 py-6">
                        <div>
                            <h3 class="font-display text-3xl font-semibold uppercase leading-none">{{ $title }}</h3>
                            <p class="mt-2 text-sm text-steel">{{ $areaName }} &middot; {{ $place }} &middot; {{ $type }}</p>
                        </div>
                        <a href="{{ route('contact', ['interest' => 'Careers']) }}"
                           class="rounded-full border border-white/40 px-6 py-2.5 text-[12.5px] font-semibold uppercase tracking-[.14em] transition hover:border-signal hover:bg-signal">Apply</a>
                    </li>
                @endforeach
            </ul>
            <p class="mt-4 text-xs text-steel">Roles are placeholders for this fictional brand.</p>
        </div>
    </section>

    {{-- Early careers --}}
    <section id="early" class="bg-navy py-20 lg:py-24">
        <div class="mx-auto grid max-w-[1440px] gap-8 px-6 lg:grid-cols-12 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:col-span-4 lg:text-6xl">Early careers</h2>
            <div data-reveal class="space-y-5 text-lg leading-relaxed text-white/75 lg:col-span-7 lg:col-start-6">
                <p>Internships, co-ops and graduate programs put you on real aircraft programs from week one, rotating through design, test and production with a dedicated mentor.</p>
                <a href="{{ route('contact', ['interest' => 'Careers']) }}" class="inline-block rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Join the talent community</a>
            </div>
        </div>
    </section>

    {{-- Benefits --}}
    <section id="benefits" class="border-t border-white/10 bg-navy-2 py-20 lg:py-24">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">Benefits</h2>
            <ul class="mt-10 grid gap-x-12 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($benefits as $b)
                    <li data-reveal class="flex gap-4 border-t border-white/10 py-5">
                        <svg class="mt-1 shrink-0 text-signal" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 5 5 9-10"/></svg>
                        <span class="text-[15px] text-white/85">{{ $b }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    @include('sections.cta')
@endsection
