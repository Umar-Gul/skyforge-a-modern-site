@extends('layouts.app')

@section('title', 'Innovation | Skyforge Aviation')
@section('description', 'Autonomy and avionics, hybrid-electric power, advanced composites and Skyforge Labs: the technology programs shaping the next generation of flight.')

@php
    $img = collect(config('skyforge.aircraft'))->pluck('image', 'slug');
    $sol = config('skyforge.solutions');
    $slides = config('skyforge.hero_slides');
    $pillars = [
        ['autonomy', 'Autonomy & avionics', 'Detect-and-avoid, automatic route planning and redundant digital flight controls let one operator supervise many aircraft, and let crews focus on the mission instead of the machine.', $img['sf-90-falcon']],
        ['hybrid', 'Hybrid-electric power', 'Electric motors handle takeoff and climb quietly, while a compact turbine generator extends range. The result is lower fuel burn, lower noise and lower operating cost.', $img['sf-450-horizon']],
        ['composites', 'Advanced composites', 'Automated layup and bonded structures cut weight and build time, which turns directly into range, payload and lower cost per flight hour.', $sol[3]['image']],
        ['labs', 'Skyforge Labs', 'Our research group prototypes the ideas that are too early for a program: new rotor concepts, battery integration, and digital twins that test aircraft before metal is cut.', $slides[0]['image']],
        ['sustainability', 'Sustainability', 'Every platform is designed to run on sustainable aviation fuel, and we measure emissions and community noise from the first sketch to the last delivery.', $sol[1]['image']],
    ];
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Innovation',
        'title'   => "Redefining\nthe future of flight.",
        'text'    => 'The research and technology programs behind every Skyforge aircraft.',
        'image'   => $slides[1]['image'],
    ])

    <section class="bg-navy py-20 lg:py-28">
        <div class="mx-auto max-w-[1440px] space-y-20 px-6 lg:space-y-28 lg:px-10">
            @foreach ($pillars as [$id, $title, $text, $image])
                <article id="{{ $id }}" class="grid items-center gap-10 lg:grid-cols-12 lg:gap-16">
                    <div data-reveal class="relative aspect-[4/3] overflow-hidden rounded-2xl bg-gradient-to-br from-navy-2 to-[#1b2c4d] ring-1 ring-white/10 lg:col-span-7 {{ $loop->odd ? '' : 'lg:order-2' }}">
                        <img src="{{ $image }}?auto=format&fit=crop&w=1400&q=80" alt="{{ $title }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover">
                    </div>
                    <div data-reveal class="lg:col-span-5">
                        <p class="font-display text-xl font-semibold text-signal">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                        <h2 class="mt-3 font-display text-5xl font-bold uppercase leading-[.95] lg:text-6xl">{{ $title }}</h2>
                        <p class="mt-6 text-lg leading-relaxed text-white/75">{{ $text }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    @include('sections.cta')
@endsection
