@extends('layouts.app')

@section('title', $story['title'] . ' | Skyforge Aviation')
@section('description', $story['excerpt'])

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => $story['tag'] . ' · ' . $story['date'],
        'crumb'   => 'News',
        'title'   => $story['title'],
        'image'   => $story['image'],
    ])

    <article class="bg-navy pb-20 lg:pb-28">
        <div class="mx-auto max-w-3xl space-y-6 px-6 text-lg leading-relaxed text-white/80 lg:px-10">
            <p class="text-2xl leading-snug text-white">{{ $story['excerpt'] }}</p>
            @foreach ($story['body'] as $p)
                <p>{{ $p }}</p>
            @endforeach
            <p class="pt-4 text-sm text-steel">This story is fictional and was written for design practice.</p>
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-[13px] font-semibold uppercase tracking-[.14em] text-white transition hover:text-signal">← All news</a>
        </div>
    </article>

    <section class="border-t border-white/10 bg-navy-2 py-20 lg:py-24">
        <div class="mx-auto max-w-[1440px] px-6 lg:px-10">
            <h2 data-reveal class="font-display text-4xl font-bold uppercase leading-none lg:text-5xl">More stories</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($others as $n)
                    @include('partials.news-card', ['n' => $n])
                @endforeach
            </div>
        </div>
    </section>

    @include('sections.cta')
@endsection
