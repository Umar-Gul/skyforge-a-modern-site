@extends('layouts.app')

@section('title', 'Aircraft | Skyforge Aviation')
@section('description', 'Explore the Skyforge fleet: vertical-lift tiltrotor, hybrid-electric regional aircraft, autonomous cargo drone and emergency response rotorcraft.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Our Aircraft',
        'crumb'   => 'Aircraft',
        'title'   => "Built for\nevery mission.",
        'text'    => 'Four platforms, one engineering philosophy: aircraft that go further, burn less and bring people home.',
        'image'   => config('skyforge.hero_slides')[1]['image'],
    ])

    <section class="bg-navy pb-24 lg:pb-32">
        <div class="mx-auto grid max-w-[1440px] gap-6 px-6 sm:grid-cols-2 lg:px-10 xl:grid-cols-4">
            @foreach (config('skyforge.aircraft') as $a)
                @include('partials.aircraft-card', ['a' => $a])
            @endforeach
        </div>
    </section>

    @include('sections.cta')
@endsection
