@extends('layouts.app')

@section('title', 'Newsroom | Skyforge Aviation')
@section('description', 'Press releases, flight-test updates and stories from Skyforge Aviation.')

@php
    $stories = config('skyforge.news');
    $tabs = ['all' => 'All', 'commercial' => 'Commercial', 'military' => 'Military', 'innovation' => 'Innovation'];
    $filter = array_key_exists($filter ?? 'all', $tabs) ? $filter : 'all';
    $events = [
        ['Oct 2026', 'Regional Aviation Summit', 'Virtual'],
        ['Nov 2026', 'Vertical Lift Technology Forum', 'Fort Worth, Texas'],
        ['Jan 2027', 'Sustainable Flight Conference', 'Toulouse, France'],
    ];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Newsroom',
        'crumb'   => 'News',
        'title'   => "The latest\nat Skyforge.",
        'text'    => 'Flight-test milestones, customer announcements and stories from the people building the next generation of aircraft.',
        'image'   => $stories[0]['image'],
    ])

    <section class="bg-navy pb-24 lg:pb-32" data-filter-group>
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <div class="flex flex-wrap gap-3" role="group" aria-label="Filter stories">
                @foreach ($tabs as $key => $label)
                    <button type="button" class="chip {{ $filter === $key ? 'is-active' : '' }}" data-filter="{{ $key }}">{{ $label }}</button>
                @endforeach
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($stories as $n)
                    @include('partials.news-card', ['n' => $n, 'hidden' => $filter !== 'all' && $filter !== $n['category']])
                @endforeach
            </div>
        </div>
    </section>

    {{-- Events --}}
    <section id="events" class="border-t border-white/10 bg-navy-2 py-20 lg:py-24">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-5xl font-bold uppercase leading-none lg:text-6xl">Events</h2>
            <ul class="mt-10 divide-y divide-white/10 border-y border-white/10">
                @foreach ($events as [$date, $name, $place])
                    <li data-reveal class="flex flex-wrap items-baseline justify-between gap-4 py-6">
                        <div class="flex items-baseline gap-8">
                            <span class="w-28 font-display text-2xl font-semibold uppercase text-signal">{{ $date }}</span>
                            <span class="font-display text-3xl font-semibold uppercase leading-none">{{ $name }}</span>
                        </div>
                        <span class="text-sm text-steel">{{ $place }}</span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-4 text-xs text-steel">Events are placeholders for this fictional brand. For media enquiries, <a href="{{ route('contact', ['interest' => 'Media & press']) }}" class="underline transition hover:text-white">contact our press team</a>.</p>
        </div>
    </section>

    @include('sections.cta')
@endsection
