@extends('layouts.app')

@section('title', ($q !== '' ? 'Search: ' . $q : 'Search') . ' | Skyforge Aviation')

@section('content')
    <section class="bg-navy pb-24 pt-40 lg:pb-32 lg:pt-52">
        <div class="mx-auto max-w-4xl px-6 lg:px-10">
            <p class="menu-eyebrow">Search Skyforge</p>
            <form action="{{ route('search') }}" method="GET" role="search" class="mt-6 flex items-center gap-4 border-b border-white/30 pb-4">
                <input type="search" name="q" value="{{ $q }}" placeholder="Search aircraft, solutions, news..." aria-label="Search" autofocus
                       class="w-full bg-transparent font-display text-4xl font-semibold uppercase placeholder-white/30 outline-none sm:text-6xl">
                <button type="submit" class="shrink-0 text-signal" aria-label="Submit search">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                </button>
            </form>

            @if ($q === '')
                <p class="mt-8 text-lg text-white/70">Type at least two letters to search aircraft, pages and news.</p>
            @elseif (count($results) === 0)
                <p class="mt-8 text-lg text-white/70">No results for &ldquo;{{ $q }}&rdquo;. Try &ldquo;hybrid&rdquo;, &ldquo;rescue&rdquo; or &ldquo;training&rdquo;.</p>
            @else
                <p class="mt-8 text-sm uppercase tracking-[.2em] text-steel">{{ count($results) }} {{ \Illuminate\Support\Str::plural('result', count($results)) }}</p>
                <ul class="mt-4 divide-y divide-white/10 border-y border-white/10">
                    @foreach ($results as [$kind, $title, $desc, $url])
                        <li>
                            <a href="{{ $url }}" class="group block py-6">
                                <p class="text-[11px] font-semibold uppercase tracking-[.25em] text-signal">{{ $kind }}</p>
                                <p class="mt-2 font-display text-3xl font-semibold uppercase leading-none transition group-hover:text-signal">{{ $title }}</p>
                                <p class="mt-2 max-w-2xl text-[15px] text-white/65">{{ \Illuminate\Support\Str::limit($desc, 140) }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection
