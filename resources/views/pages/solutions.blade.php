@extends('layouts.app')

@section('title', 'Solutions | Skyforge Aviation')
@section('description', 'Skyforge solutions for regional transport, cargo and logistics, air medical, vertical lift, surveillance and logistics support.')

@php
    $img = collect(config('skyforge.aircraft'))->pluck('image', 'slug');
    $sol = config('skyforge.solutions');
    $groups = [
        ['Commercial', [
            ['Regional transport', 'Short sectors where noise limits and operating cost have held back service. The hybrid-electric Horizon opens routes that conventional aircraft struggle to serve profitably.', $img['sf-450-horizon'], 'sf-450-horizon'],
            ['Cargo & logistics', 'Autonomous aircraft that move freight to places where roads and runways are slow, unsafe or missing, with one operator supervising a whole fleet.', $img['sf-90-falcon'], 'sf-90-falcon'],
            ['Air medical', 'Rapid-response rotorcraft built around the first hour after an emergency, landing on rooftops, roadways and in clearings.', $img['sf-120-guardian'], 'sf-120-guardian'],
        ]],
        ['Defense', [
            ['Vertical lift', 'A tiltrotor that takes off like a helicopter and cruises like an aircraft, reaching austere sites without a runway.', $img['sf-200-vanguard'], 'sf-200-vanguard'],
            ['Surveillance & reconnaissance', 'Long-endurance autonomous platforms that extend situational awareness without putting crews at risk.', $sol[0]['image'], 'sf-90-falcon'],
            ['Logistics support', 'Autonomous resupply that keeps forward sites stocked, with encrypted links and automatic return-home logic.', $img['sf-90-falcon'], 'sf-90-falcon'],
        ]],
    ];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Solutions',
        'title'   => "The right aircraft\nfor every mission.",
        'text'    => 'From regional routes to rescue and defense, Skyforge platforms are designed around what the mission demands.',
        'image'   => $sol[1]['image'],
    ])

    @foreach ($groups as [$group, $missions])
        <section class="bg-navy py-20 lg:py-28 {{ $loop->last ? '' : 'border-b border-white/10' }}">
            <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
                <p data-reveal class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">{{ $group }}</p>

                <div class="mt-12 space-y-20 lg:space-y-28">
                    @foreach ($missions as [$title, $text, $image, $slug])
                        <article id="{{ \Illuminate\Support\Str::slug($title) }}" class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">
                            <div data-reveal class="relative aspect-[4/3] overflow-hidden rounded-2xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10 lg:col-span-7 {{ $loop->odd ? '' : 'lg:order-2' }}">
                                <img src="{{ $image }}?auto=format&fit=crop&w=1400&q=80" alt="{{ $title }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover">
                            </div>
                            <div data-reveal class="lg:col-span-5">
                                <h2 class="font-display text-5xl font-bold uppercase leading-[.95] lg:text-6xl">{{ $title }}</h2>
                                <p class="mt-6 text-lg leading-relaxed text-white/75">{{ $text }}</p>
                                <div class="mt-8 flex flex-wrap gap-4">
                                    <a href="{{ route('aircraft.show', $slug) }}" class="rounded-full bg-signal px-7 py-3 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">See the aircraft</a>
                                    <a href="{{ route('contact', ['interest' => 'Aircraft sales']) }}" class="rounded-full border border-white/40 px-7 py-3 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:border-white hover:bg-white/10">Talk to sales</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    @include('sections.cta')
@endsection
