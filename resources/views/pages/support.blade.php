@extends('layouts.app')

@section('title', 'Services & Support | Skyforge Aviation')
@section('description', 'Maintenance programs, spare parts, pilot and maintainer training, simulators and service centers for every Skyforge aircraft.')

@php
    $sol = config('skyforge.solutions');
    $blocks = [
        ['maintenance', 'Maintenance', 'Keep every aircraft mission-ready with programs designed around your operation.', [
            ['Maintenance programs', 'Scheduled and on-condition programs with fixed-cost options and predictable downtime.'],
            ['Spare parts', 'Regional stocking locations and a 24/7 aircraft-on-ground desk for urgent needs.'],
            ['Technical publications', 'Digital manuals, service bulletins and illustrated parts data, always current.'],
        ]],
        ['training', 'Training', 'Type ratings and recurrent courses for flight crews and maintainers.', [
            ['Pilot training', 'Type-rating and recurrent courses that combine ground school with full-motion simulation.'],
            ['Maintainer training', 'Hands-on technical courses covering airframe, propulsion, avionics and composite repair.'],
            ['Simulators', 'High-fidelity devices that let crews rehearse emergencies and mission profiles safely.'],
        ]],
        ['service', 'Service centers', 'Support close to where you fly.', [
            ['Find a service center', 'Authorized centers in North America, Europe, the Middle East and Asia-Pacific.'],
            ['Mobile response teams', 'Technicians who travel to the aircraft when it cannot come to us.'],
            ['Warranty', 'Clear coverage terms and a single point of contact for every claim.'],
        ]],
    ];
    $centers = [['North America', 'Fort Worth, Texas'], ['Europe', 'Toulouse, France'], ['Middle East', 'Dubai, UAE'], ['Asia-Pacific', 'Singapore']];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Services & Support',
        'crumb'   => 'Support',
        'title'   => "Mission-ready,\nworldwide.",
        'text'    => 'From the first delivery to the last flight hour, Skyforge support keeps your fleet flying.',
        'image'   => $sol[3]['image'],
    ])

    @foreach ($blocks as [$id, $title, $lead, $items])
        <section id="{{ $id }}" class="bg-navy py-20 lg:py-24 {{ $loop->first ? '' : 'border-t border-white/10' }}">
            <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
                <div class="grid gap-8 lg:grid-cols-12">
                    <div data-reveal class="lg:col-span-4">
                        <h2 class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">{{ $title }}</h2>
                        <p class="mt-5 max-w-sm text-lg leading-relaxed text-white/70">{{ $lead }}</p>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-3 lg:col-span-8">
                        @foreach ($items as [$name, $text])
                            <div data-reveal class="cap-card pt-6">
                                <h3 class="font-display text-2xl font-semibold uppercase leading-none">{{ $name }}</h3>
                                <p class="mt-4 text-[15px] leading-relaxed text-white/70">{{ $text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($id === 'service')
                    <div class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($centers as [$region, $city])
                            <div data-reveal class="rounded-2xl bg-navy-2 p-6 ring-1 ring-white/10">
                                <p class="menu-eyebrow">{{ $region }}</p>
                                <p class="mt-3 font-display text-2xl font-semibold uppercase leading-none">{{ $city }}</p>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-4 text-xs text-steel">Locations are placeholders for this fictional brand.</p>
                @endif
            </div>
        </section>
    @endforeach

    {{-- Flight safety --}}
    <section id="safety" class="border-t border-white/10 bg-navy-2 py-20 lg:py-24">
        <div class="mx-auto grid max-w-[1440px] gap-8 px-6 lg:grid-cols-12 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:col-span-4 lg:text-6xl">Flight safety</h2>
            <div data-reveal class="space-y-5 text-lg leading-relaxed text-white/75 lg:col-span-7 lg:col-start-6">
                <p>Safety is a shared responsibility. We publish safety information notices, run operator safety forums, and review in-service data with customers so lessons from one aircraft protect every other.</p>
                <p>If you have a safety concern or want to report an occurrence, contact our support team at any hour.</p>
                <a href="{{ route('contact', ['interest' => 'Service & support']) }}" class="inline-block rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Contact support</a>
            </div>
        </div>
    </section>

    @include('sections.cta')
@endsection
