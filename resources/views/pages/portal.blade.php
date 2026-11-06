@extends('layouts.app')

@section('title', __('Dashboard') . ' | Skyforge Aviation')

@php
    $labels = ['customer' => 'Customer portal', 'supplier' => 'Supplier portal', 'employee' => 'Employee portal'];

    // Shortcuts into the existing site, per portal: [title, description, url]
    $cards = [
        'customer' => [
            ['Browse aircraft', 'Specs and details for the full Skyforge fleet.', route('aircraft.index')],
            ['Request service', 'Open a service or support request with our team.', route('contact', ['interest' => 'Service & support'])],
            ['Training', 'Pilot and maintainer courses on full-motion simulators.', route('support') . '#training'],
        ],
        'supplier' => [
            ['Contact procurement', 'Reach the supply chain team about orders and deliveries.', route('contact', ['interest' => 'Other'])],
            ['About Skyforge', 'Mission, values and the aircraft you help build.', route('company')],
            ['Newsroom', 'Programs and announcements that affect production.', route('news.index')],
        ],
        'employee' => [
            ['Newsroom', 'The latest company stories and announcements.', route('news.index')],
            ['Safety', 'Our flight-safety commitments and reporting.', route('support') . '#safety'],
            ['Open roles', 'Refer a colleague to a current vacancy.', route('careers') . '#roles'],
        ],
    ][$portal];
@endphp

@section('content')
    <section class="bg-navy pb-24 pt-36 lg:pt-44">
        <div class="mx-auto max-w-[1100px] px-6 lg:px-10">
            <p class="menu-eyebrow">{{ __($labels[$portal]) }}</p>
            <h1 class="mt-4 font-display text-6xl font-bold uppercase leading-[.92] sm:text-7xl">{{ __('Welcome back') }}, {{ \Illuminate\Support\Str::of($user->name)->before(' ') }}</h1>

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @foreach ($cards as [$title, $text, $url])
                    <a href="{{ $url }}" class="group rounded-2xl border border-white/10 bg-navy-2 p-7 transition hover:border-signal">
                        <h2 class="font-display text-2xl font-semibold uppercase leading-none">{{ __($title) }}</h2>
                        <p class="mt-3 text-[15px] leading-relaxed text-white/70">{{ __($text) }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 grid gap-8 rounded-2xl border border-white/10 p-7 sm:grid-cols-2 sm:p-10">
                <div>
                    <p class="menu-eyebrow">{{ __('Your account') }}</p>
                    <dl class="mt-4 space-y-3 text-[15px]">
                        <div class="flex gap-4"><dt class="w-28 shrink-0 text-steel">{{ __('Name') }}</dt><dd>{{ $user->name }}</dd></div>
                        <div class="flex gap-4"><dt class="w-28 shrink-0 text-steel">{{ __('Email') }}</dt><dd class="break-all">{{ $user->email }}</dd></div>
                        @if ($user->company)
                            <div class="flex gap-4"><dt class="w-28 shrink-0 text-steel">{{ __('Company') }}</dt><dd>{{ $user->company }}</dd></div>
                        @endif
                        <div class="flex gap-4"><dt class="w-28 shrink-0 text-steel">{{ __('Portal') }}</dt><dd>{{ __($labels[$portal]) }}</dd></div>
                    </dl>
                </div>
                <div class="flex items-end sm:justify-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-white/30 px-8 py-3 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:border-signal hover:text-signal">{{ __('Sign out') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
