@extends('layouts.app')

@section('title', 'Contact | Skyforge Aviation')
@section('description', 'Talk to Skyforge Aviation about aircraft sales, service and support, training or careers.')

@php
    $interests = array_merge(
        ['Aircraft sales', 'Service & support', 'Training', 'Careers', 'Media & press', 'Other'],
        array_column(config('skyforge.aircraft'), 'name')
    );
    $selected = old('interest', request('interest'));
    $field = 'w-full rounded-xl border bg-transparent px-5 py-3.5 text-[15px] text-white placeholder-white/35 outline-none transition focus:border-signal';
@endphp

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Contact',
        'title'   => "Let's talk.",
        'text'    => 'Tell us about your mission and the right team will get back to you within two working days.',
    ])

    <section class="bg-navy pb-24 lg:pb-32">
        <div class="mx-auto grid max-w-[1440px] gap-14 px-6 lg:grid-cols-12 lg:px-10">

            {{-- Form --}}
            <div class="lg:col-span-7" data-reveal>
                @if (session('sent'))
                    <div role="status" class="mb-8 rounded-2xl border border-signal/40 bg-signal/10 p-6">
                        <p class="font-display text-2xl font-semibold uppercase">Message received</p>
                        <p class="mt-2 text-[15px] text-white/80">Thank you. A member of the Skyforge team will reply shortly.</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" novalidate class="grid gap-6 sm:grid-cols-2">
                    @csrf

                    {{-- Honeypot: hidden from people, tempting for bots --}}
                    <div class="hidden" aria-hidden="true">
                        <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <div>
                        <label for="name" class="menu-eyebrow">Full name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required
                               class="{{ $field }} mt-3 {{ $errors->has('name') ? 'border-red-400' : 'border-white/20' }}">
                        @error('name') <p class="mt-2 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="menu-eyebrow">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required
                               class="{{ $field }} mt-3 {{ $errors->has('email') ? 'border-red-400' : 'border-white/20' }}">
                        @error('email') <p class="mt-2 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="company" class="menu-eyebrow">Company (optional)</label>
                        <input id="company" name="company" type="text" value="{{ old('company') }}" autocomplete="organization"
                               class="{{ $field }} mt-3 border-white/20">
                    </div>

                    <div>
                        <label for="interest" class="menu-eyebrow">I am interested in</label>
                        <select id="interest" name="interest" required
                                class="{{ $field }} mt-3 {{ $errors->has('interest') ? 'border-red-400' : 'border-white/20' }}">
                            <option value="" class="bg-navy">Select a topic</option>
                            @foreach ($interests as $i)
                                <option value="{{ $i }}" class="bg-navy" @selected($selected === $i)>{{ $i }}</option>
                            @endforeach
                        </select>
                        @error('interest') <p class="mt-2 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="menu-eyebrow">How can we help?</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="{{ $field }} mt-3 {{ $errors->has('message') ? 'border-red-400' : 'border-white/20' }}">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-2 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <button type="submit"
                                class="rounded-full bg-signal px-10 py-4 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">
                            Send message
                        </button>
                    </div>
                </form>
            </div>

            {{-- Details --}}
            <aside class="space-y-10 lg:col-span-4 lg:col-start-9" data-reveal>
                @foreach ([
                    ['Sales', 'sales@skyforge.example', '+1 (555) 010-2000'],
                    ['Service & support', 'support@skyforge.example', '+1 (555) 010-2100'],
                    ['Media', 'press@skyforge.example', '+1 (555) 010-2200'],
                ] as [$label, $mail, $tel])
                    <div class="border-t border-white/10 pt-6">
                        <p class="menu-eyebrow">{{ $label }}</p>
                        <p class="mt-3"><a href="mailto:{{ $mail }}" class="transition hover:text-signal">{{ $mail }}</a></p>
                        <p class="mt-1 text-steel">{{ $tel }}</p>
                    </div>
                @endforeach

                <div class="border-t border-white/10 pt-6">
                    <p class="menu-eyebrow">Headquarters</p>
                    <p class="mt-3 leading-relaxed text-white/80">100 Skyline Drive<br>Fort Worth, Texas<br>United States</p>
                    <p class="mt-4 text-xs text-steel">Skyforge Aviation is a fictional brand. Contact details are placeholders.</p>
                </div>
            </aside>
        </div>
    </section>
@endsection
