@extends('layouts.app')

@section('title', 'Page not found | Skyforge Aviation')

@section('content')
    <section class="flex min-h-screen items-center bg-navy px-6 pb-20 pt-32 lg:px-10">
        <div class="mx-auto w-full max-w-[1440px]">
            <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Error 404</p>
            <h1 class="mt-5 font-display text-7xl font-bold uppercase leading-[.92] lg:text-[9rem]">Off the<br>flight plan.</h1>
            <p class="mt-8 max-w-xl text-lg leading-relaxed text-white/75">The page you were looking for has moved or never existed. Let&rsquo;s get you back on course.</p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('home') }}" class="rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Back to home</a>
                <a href="{{ route('aircraft.index') }}" class="rounded-full border border-white/40 px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:border-white hover:bg-white/10">View aircraft</a>
            </div>
        </div>
    </section>
@endsection
