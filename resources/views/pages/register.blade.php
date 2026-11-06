@extends('layouts.app')

@section('title', __('Create an account') . ' | Skyforge Aviation')

@php
    $selected = old('portal', request('portal', 'customer'));
    if (! in_array($selected, ['customer', 'supplier'], true)) { $selected = 'customer'; }
    $fields = [
        ['name', 'Full name', 'text', 'name'],
        ['email', 'Email', 'email', 'email'],
        ['company', 'Company (optional)', 'text', 'organization'],
    ];
@endphp

@section('content')
    <section class="relative min-h-screen overflow-hidden bg-navy pb-24 pt-36 lg:pt-44">
        <div class="absolute inset-0 bg-gradient-to-b from-navy-2 to-navy"></div>

        <div class="relative mx-auto max-w-[720px] px-6 lg:px-10">
            <p class="menu-eyebrow">{{ __('Skyforge portals') }}</p>
            <h1 class="mt-4 font-display text-6xl font-bold uppercase leading-[.92] sm:text-7xl">{{ __('Create an account') }}</h1>

            <div class="mt-10 rounded-2xl border border-white/10 bg-navy-2/80 p-6 sm:p-10">
                <form method="POST" action="{{ route('register.attempt') }}" novalidate class="grid gap-6">
                    @csrf

                    <fieldset>
                        <legend class="menu-eyebrow">{{ __('I am a') }}</legend>
                        <div class="mt-3 flex flex-wrap gap-3">
                            @foreach (['customer' => 'Customer', 'supplier' => 'Supplier'] as $v => $l)
                                <label class="cursor-pointer">
                                    <input type="radio" name="portal" value="{{ $v }}" class="peer sr-only" {{ $selected === $v ? 'checked' : '' }}>
                                    <span class="chip inline-block peer-checked:border-signal peer-checked:bg-signal peer-focus-visible:ring-2 peer-focus-visible:ring-white">{{ __($l) }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('portal') <p class="mt-2 text-sm text-red-300" role="alert">{{ $message }}</p> @enderror
                    </fieldset>

                    @foreach ($fields as [$name, $label, $type, $auto])
                        <div>
                            <label for="{{ $name }}" class="menu-eyebrow">{{ __($label) }}</label>
                            <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name) }}" autocomplete="{{ $auto }}" @if ($name !== 'company') required @endif
                                   class="auth-input mt-3 {{ $errors->has($name) ? 'is-invalid' : '' }}">
                            @error($name) <p class="mt-2 text-sm text-red-300" role="alert">{{ $message }}</p> @enderror
                        </div>
                    @endforeach

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="password" class="menu-eyebrow">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                   class="auth-input mt-3 {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            @error('password') <p class="mt-2 text-sm text-red-300" role="alert">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="menu-eyebrow">{{ __('Confirm password') }}</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="auth-input mt-3">
                        </div>
                    </div>
                    <p class="-mt-2 text-[13px] text-steel">{{ __('Use at least 8 characters.') }}</p>

                    <button type="submit" class="rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">
                        {{ __('Create an account') }}
                    </button>
                </form>

                <p class="mt-8 border-t border-white/10 pt-6 text-[14px] text-steel">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="font-medium text-white underline transition hover:text-signal">{{ __('Sign in') }}</a>
                </p>
            </div>
        </div>
    </section>
@endsection
