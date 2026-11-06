@extends('layouts.app')

@section('title', 'Company | Skyforge Aviation')
@section('description', 'Skyforge Aviation builds next-generation aircraft for the missions that move the world forward. Our story, values and leadership.')

@php
    $values = [
        ['Safety first', 'Every design decision is tested against one question: does it bring the crew and passengers home?'],
        ['Engineered to last', 'We build for decades of service, with open maintenance data and parts support in every region.'],
        ['Quieter, cleaner flight', 'Hybrid-electric power and smarter aerodynamics cut noise and emissions on every route.'],
        ['People before platforms', 'Our engineers, pilots and technicians shape the aircraft. The best ideas come from the hangar floor.'],
    ];
    $timeline = [
        ['2014', 'Skyforge is founded by a small team of rotorcraft and avionics engineers.'],
        ['2017', 'First autonomous cargo flight: the Falcon prototype delivers medical supplies across a mountain valley.'],
        ['2020', 'Hybrid-electric demonstrator completes its first test campaign.'],
        ['2023', 'The Vanguard tiltrotor makes its first hover flight.'],
        ['2026', 'Vanguard completes its first full transition flight, and Guardian enters service.'],
    ];
    $leaders = [
        ['Amelia Hart', 'Chief Executive Officer'],
        ['Rashid Karimi', 'Chief Technology Officer'],
        ['Lena Brandt', 'Chief Operating Officer'],
        ['Daniel Okafor', 'Head of Flight Test'],
    ];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Company',
        'title'   => "Engineered\nto rise.",
        'text'    => 'Skyforge Aviation designs aircraft for the missions that matter most: moving people, cargo and help to where they are needed.',
        'image'   => config('skyforge.hero_slides')[0]['image'],
    ])

    {{-- Mission --}}
    <section class="bg-navy py-24 lg:py-32">
        <div class="mx-auto grid max-w-[1440px] gap-12 px-6 lg:grid-cols-12 lg:px-10">
            <p data-reveal class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal lg:col-span-3">Our mission</p>
            <p data-reveal class="font-display text-4xl font-semibold uppercase leading-[1.05] sm:text-5xl lg:col-span-9 lg:text-6xl">
                We build aircraft that go further, burn less and bring people home, and we back every one with the support to keep it flying.
            </p>
        </div>
    </section>

    {{-- Values --}}
    <section class="border-y border-white/10 bg-navy-2 py-24 lg:py-28">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">What we stand for</h2>
            <div class="mt-14 grid gap-x-10 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($values as $i => [$title, $text])
                    <div data-reveal class="cap-card pt-8">
                        <p class="font-display text-xl font-semibold text-signal">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-3 font-display text-3xl font-semibold uppercase leading-none">{{ $title }}</h3>
                        <p class="mt-4 text-[15px] leading-relaxed text-white/70">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Timeline --}}
    <section class="bg-navy py-24 lg:py-32">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">Our journey</h2>
            <ol class="mt-14 divide-y divide-white/10 border-y border-white/10">
                @foreach ($timeline as [$year, $text])
                    <li data-reveal class="grid gap-3 py-8 sm:grid-cols-12 sm:gap-10">
                        <span class="font-display text-5xl font-bold text-signal sm:col-span-2">{{ $year }}</span>
                        <p class="max-w-3xl text-lg leading-relaxed text-white/80 sm:col-span-10">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Leadership --}}
    <section id="leadership" class="border-t border-white/10 bg-navy-2 py-24 lg:py-28">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">Leadership</h2>
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($leaders as [$name, $role])
                    <div data-reveal class="rounded-2xl bg-navy p-8 ring-1 ring-white/10">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-signal font-display text-2xl font-bold" aria-hidden="true">
                            {{ collect(explode(' ', $name))->map(fn ($p) => $p[0])->join('') }}
                        </div>
                        <h3 class="mt-6 font-display text-3xl font-semibold uppercase leading-none">{{ $name }}</h3>
                        <p class="mt-2 text-sm text-steel">{{ $role }}</p>
                    </div>
                @endforeach
            </div>
            <p class="mt-6 text-xs text-steel">Names and profiles are placeholders for this fictional brand.</p>
        </div>
    </section>

    @include('sections.cta')
@endsection
