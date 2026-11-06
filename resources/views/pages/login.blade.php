@extends('layouts.app')

@section('title', __('Sign in') . ' | Skyforge Aviation')

@php
    $portals = [
        'customer' => ['Customer portal', 'Manage fleet, orders and service requests'],
        'supplier' => ['Supplier portal', 'Purchase orders, deliveries and certifications'],
        'employee' => ['Employee portal', 'Tools, news and resources for the team'],
    ];
    $selected = old('portal', $portal);
@endphp

@section('content')
    <section class="relative min-h-screen overflow-hidden bg-navy pb-24 pt-36 lg:pt-44">
        <img src="{{ config('skyforge.cta_image') ?? config('skyforge.hero_slides')[0]['image'] }}?auto=format&fit=crop&w=2000&q=70" alt="" aria-hidden="true"
             class="absolute inset-0 h-full w-full object-cover opacity-25">
        <div class="absolute inset-0 bg-gradient-to-b from-navy/80 via-navy/70 to-navy"></div>

        <div class="relative mx-auto grid max-w-[1100px] gap-12 px-6 lg:grid-cols-12 lg:px-10">
            <div class="lg:col-span-5">
                <p class="menu-eyebrow">{{ __('Skyforge portals') }}</p>
                <h1 class="mt-4 font-display text-6xl font-bold uppercase leading-[.92] sm:text-7xl">{{ __('Welcome back') }}</h1>
                <p class="mt-6 max-w-md text-[16px] leading-relaxed text-white/75">{{ __('Sign in to the portal for your role to manage your account with Skyforge.') }}</p>
            </div>

            <div class="lg:col-span-7">
                <div class="rounded-2xl border border-white/10 bg-navy-2/80 p-6 backdrop-blur sm:p-10">
                    <div class="flex flex-wrap gap-2" role="tablist" aria-label="{{ __('Portal') }}">
                        @foreach ($portals as $slug => [$label])
                            <a href="{{ route('login', $slug) }}" role="tab" aria-selected="{{ $selected === $slug ? 'true' : 'false' }}"
                               class="chip {{ $selected === $slug ? 'is-active' : '' }}">{{ __($label) }}</a>
                        @endforeach
                    </div>
                    <p class="mt-4 text-[14px] text-steel">{{ __($portals[$selected][1]) }}</p>

                    <form method="POST" action="{{ route('login.attempt') }}" novalidate class="mt-8 grid gap-6">
                        @csrf
                        <input type="hidden" name="portal" value="{{ $selected }}">

                        <div>
                            <label for="email" class="menu-eyebrow">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus
                                   class="auth-input mt-3 {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            @error('email') <p class="mt-2 text-sm text-red-300" role="alert">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password" class="menu-eyebrow">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="auth-input mt-3 {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            @error('password') <p class="mt-2 text-sm text-red-300" role="alert">{{ $message }}</p> @enderror
                        </div>

                        <label class="flex items-center gap-3 text-[14px] text-white/75">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 accent-[#ff5a1f]">
                            {{ __('Remember me') }}
                        </label>

                        <button type="submit" class="rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">
                            {{ __('Sign in') }}
                        </button>
                    </form>

                    @if ($selected !== 'employee')
                        <p class="mt-8 border-t border-white/10 pt-6 text-[14px] text-steel">
                            {{ __('New here?') }}
                            <a href="{{ route('register') }}" class="font-medium text-white underline transition hover:text-signal">{{ __('Create an account') }}</a>
                        </p>
                    @else
                        <p class="mt-8 border-t border-white/10 pt-6 text-[14px] text-steel">{{ __('Employee accounts are created by your administrator.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
