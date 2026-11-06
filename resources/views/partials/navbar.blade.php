@php
    $aircraft = config('skyforge.aircraft');
    $sol = config('skyforge.solutions');
    $news = config('skyforge.news');

    // key, label, link
    $nav = [
        ['aircraft', __('Aircraft'), route('aircraft.index')],
        ['solutions', __('Solutions'), route('solutions')],
        ['innovation', __('Innovation'), route('innovation')],
        ['support', __('Support'), route('support')],
        ['careers', __('Careers'), route('careers')],
        ['company', __('Company'), route('company')],
    ];

    $aircraftTabs = [
        'commercial' => [['SF-450 Horizon', 'Regional hybrid-electric'], ['SF-90 Falcon', 'Autonomous cargo drone'], ['SF-120 Guardian', 'Emergency response rotorcraft']],
        'defense' => [['SF-200 Vanguard', 'Vertical-lift tiltrotor'], ['SF-90 Falcon', 'Autonomous resupply'], ['SF-120 Guardian', 'Medevac rotorcraft']],
    ];
    $solutionTabs = [
        'commercial' => ['Regional transport', 'Cargo & logistics', 'Air medical'],
        'defense' => ['Vertical lift', 'Surveillance & reconnaissance', 'Logistics support'],
    ];
    $innovation = ['Autonomy & avionics', 'Hybrid-electric power', 'Advanced composites', 'Skyforge Labs', 'Sustainability'];
    $support = [
        'Maintenance' => ['Maintenance programs', 'Spare parts', 'Technical publications'],
        'Training' => ['Pilot training', 'Maintainer training', 'Simulators'],
        'Service centers' => ['Find a service center', 'Mobile response teams', 'Warranty'],
    ];
    $careers = ['Open roles', 'Early careers', 'Life at Skyforge', 'Benefits'];
    $jobAreas = ['Engineering', 'Manufacturing', 'Flight operations', 'Business & finance'];
    $company = ['About us', 'Leadership', 'Sustainability', 'Safety'];
    $newsLinks = ['Newsroom', 'Press releases', 'Events', 'Media kit'];
    $locales = config('skyforge.locales');
    $locale = app()->getLocale();
    $portals = [
        'customer' => ['Customer portal', 'Manage fleet, orders and service requests'],
        'supplier' => ['Supplier portal', 'Purchase orders, deliveries and certifications'],
        'employee' => ['Employee portal', 'Tools, news and resources for the team'],
    ];
    $roles = config('skyforge.roles');
    $roleCounts = array_count_values(array_column($roles, 1));
    $aircraftByName = collect($aircraft)->keyBy('name')->all();

    // One-line descriptions shown under menu links on hover
    $hint = [
        'Regional transport' => 'Hybrid-electric service for short-haul routes',
        'Cargo & logistics' => 'Autonomous resupply to hard-to-reach sites',
        'Air medical' => 'Rescue rotorcraft for the first critical hour',
        'Vertical lift' => 'Tiltrotor reach without a runway',
        'Surveillance & reconnaissance' => 'Persistent coverage over wide areas',
        'Logistics support' => 'Move people and supplies at speed',
        'Autonomy & avionics' => 'Detect-and-avoid and fleet supervision',
        'Hybrid-electric power' => 'Quieter flight, lower operating cost',
        'Advanced composites' => 'Lighter wings from automated layup',
        'Skyforge Labs' => 'Where next-generation concepts are tested',
        'Sustainability' => 'SAF-ready aircraft and lower noise',
        'Maintenance programs' => 'Scheduled care that keeps fleets ready',
        'Spare parts' => 'Genuine parts shipped worldwide',
        'Technical publications' => 'Manuals, bulletins and service letters',
        'Pilot training' => 'Type ratings on full-motion simulators',
        'Maintainer training' => 'Hands-on technical courses',
        'Simulators' => 'Full-motion training devices',
        'Find a service center' => 'Authorized centers near you',
        'Mobile response teams' => 'Technicians dispatched to your aircraft',
        'Warranty' => 'Coverage terms and claims',
        'Open roles' => 'Browse current vacancies',
        'Early careers' => 'Graduate and apprentice programs',
        'Life at Skyforge' => 'Teams, mentors and culture',
        'Benefits' => 'What we offer our people',
        'About us' => 'Mission, values and timeline',
        'Leadership' => 'The people steering Skyforge',
        'Safety' => 'Our flight-safety commitments',
        'Newsroom' => 'Latest stories and announcements',
        'Press releases' => 'Official company statements',
        'Events' => 'Airshows and industry gatherings',
        'Media kit' => 'Logos, photos and press contacts',
    ];

    // Label -> URL for every menu item, so no menu link is a dead "#"
    $slug = fn (string $s) => \Illuminate\Support\Str::slug($s);
    $map = [];
    foreach ($aircraft as $a) { $map[$a['name']] = route('aircraft.show', $a['slug']); }
    foreach (array_merge($solutionTabs['commercial'], $solutionTabs['defense']) as $l) { $map[$l] = route('solutions') . '#' . $slug($l); }
    foreach ($jobAreas as $l) { $map[$l] = route('careers', ['area' => $l]) . '#roles'; }
    $map += [
        'Autonomy & avionics'    => route('innovation') . '#autonomy',
        'Hybrid-electric power'  => route('innovation') . '#hybrid',
        'Advanced composites'    => route('innovation') . '#composites',
        'Skyforge Labs'          => route('innovation') . '#labs',
        'Sustainability'         => route('innovation') . '#sustainability',
        'Maintenance programs'   => route('support') . '#maintenance',
        'Spare parts'            => route('support') . '#maintenance',
        'Technical publications' => route('support') . '#maintenance',
        'Pilot training'         => route('support') . '#training',
        'Maintainer training'    => route('support') . '#training',
        'Simulators'             => route('support') . '#training',
        'Find a service center'  => route('support') . '#service',
        'Mobile response teams'  => route('support') . '#service',
        'Warranty'               => route('support') . '#service',
        'Open roles'             => route('careers') . '#roles',
        'Early careers'          => route('careers') . '#early',
        'Life at Skyforge'       => route('careers') . '#life',
        'Benefits'               => route('careers') . '#benefits',
        'About us'               => route('company'),
        'Leadership'             => route('company') . '#leadership',
        'Safety'                 => route('support') . '#safety',
        'Newsroom'               => route('news.index'),
        'Press releases'         => route('news.index'),
        'Events'                 => route('news.index') . '#events',
        'Media kit'              => route('contact', ['interest' => 'Media & press']),
    ];
    $linkTo = fn (string $label, string $fallback = '#') => $map[$label] ?? $fallback;
@endphp

<header id="site-header" class="fixed inset-x-0 top-0 z-50">
    <div class="mx-auto flex h-20 max-w-[1440px] items-center justify-between gap-6 px-6 xl:px-10">

        @include('partials.logo')

        {{-- Desktop navigation --}}
        <nav class="hidden items-center gap-7 text-[12.5px] font-medium uppercase tracking-[.12em] xl:flex 2xl:gap-9" aria-label="Primary">
            @foreach ($nav as [$key, $label, $href])
                <a href="{{ $href }}" class="nav-link py-2 {{ request()->routeIs($key === 'aircraft' ? 'aircraft.*' : $key) ? 'is-current' : '' }}" data-menu-trigger="{{ $key }}" aria-expanded="false">{{ $label }}</a>
            @endforeach
        </nav>

        {{-- Utilities --}}
        <div class="flex items-center gap-1 sm:gap-2">

            {{-- Language switcher --}}
            <div class="relative hidden h-20 items-center xl:flex">
                <button type="button" class="inline-flex items-center gap-1.5 px-3 py-2 text-[12.5px] font-medium uppercase tracking-[.12em] text-white/90 transition hover:text-white" data-menu-trigger="lang" aria-expanded="false" aria-label="{{ __('Language') }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg>
                    {{ strtoupper($locale) }}
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="mega-panel absolute right-0 top-full hidden w-64 rounded-b-xl border border-t-0 border-white/10 bg-navy p-5 xl:block" data-menu-panel="lang">
                    <p class="menu-eyebrow">{{ __('Language') }}</p>
                    <ul class="mt-3">
                        @foreach ($locales as $code => [$langName])
                            <li>
                                <a href="{{ route('lang', $code) }}" lang="{{ $code }}" hreflang="{{ $code }}"
                                   class="menu-link flex items-center justify-between {{ $code === $locale ? 'text-white' : '' }}"
                                   @if ($code === $locale) aria-current="true" @endif>
                                    <span>{{ $langName }}</span>
                                    @if ($code === $locale)
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-signal"><path d="m5 12 5 5 9-10"/></svg>
                                    @else
                                        <span class="text-[11px] uppercase tracking-[.18em] text-steel">{{ $code }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Login / account --}}
            <div class="relative hidden h-20 items-center xl:flex">
                <button type="button" class="inline-flex items-center gap-1.5 px-3 py-2 text-[12.5px] font-medium uppercase tracking-[.12em] text-white/90 transition hover:text-white" data-menu-trigger="login" aria-expanded="false">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                    @auth {{ \Illuminate\Support\Str::of(auth()->user()->name)->before(' ')->limit(12) }} @else {{ __('Login') }} @endauth
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="mega-panel absolute right-0 top-full hidden w-80 rounded-b-xl border border-t-0 border-white/10 bg-navy p-5 xl:block" data-menu-panel="login">
                    @auth
                        <p class="menu-eyebrow">{{ __('Signed in as') }}</p>
                        <p class="mt-2 truncate text-[15px] font-medium text-white">{{ auth()->user()->name }}</p>
                        <p class="truncate text-[13px] text-steel">{{ auth()->user()->email }}</p>
                        <ul class="mt-4 border-t border-white/10 pt-3">
                            <li>@include('partials.menu-item', ['label' => __('Dashboard'), 'href' => route('portal'), 'desc' => __(($portals[auth()->user()->portal ?? 'customer'] ?? $portals['customer'])[0])])</li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="menu-link w-full text-start font-medium">{{ __('Sign out') }}</button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <p class="menu-eyebrow">{{ __('Sign in') }}</p>
                        <ul class="mt-3">
                            @foreach ($portals as $slug => [$pLabel, $pDesc])
                                <li>@include('partials.menu-item', ['label' => __($pLabel), 'href' => route('login', $slug), 'desc' => __($pDesc)])</li>
                            @endforeach
                        </ul>
                        <p class="mt-4 border-t border-white/10 pt-4 text-[13px] text-steel">
                            {{ __('New here?') }}
                            <a href="{{ route('register') }}" class="font-medium text-white underline transition hover:text-signal">{{ __('Create an account') }}</a>
                        </p>
                    @endauth
                </div>
            </div>

            <button type="button" class="flex h-10 w-10 items-center justify-center rounded-full transition hover:bg-white/10" data-search-open data-menu-none aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            </button>

            <a href="{{ route('contact') }}" data-menu-none class="ml-2 hidden rounded-full bg-signal px-6 py-2.5 text-[12.5px] font-semibold uppercase tracking-[.12em] transition hover:bg-white hover:text-navy xl:inline-block">
                {{ __('Contact Sales') }}
            </a>

            <button id="burger" class="flex h-10 w-10 flex-col items-center justify-center gap-1.5 xl:hidden" aria-label="Open menu">
                <span class="h-0.5 w-6 bg-white"></span>
                <span class="h-0.5 w-6 bg-white"></span>
                <span class="h-0.5 w-4 self-end bg-white"></span>
            </button>
        </div>
    </div>

    {{-- Mega panel: Aircraft (tabs + model list with specs + live preview card) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="aircraft">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10" data-tabs data-preview-group>
            <div class="col-span-2">
                <p class="menu-eyebrow">{{ __('Aircraft') }}</p>
                <div class="mt-4 flex flex-col">
                    @foreach (array_keys($aircraftTabs) as $k)
                        <button type="button" class="menu-tab {{ $loop->first ? 'is-active' : '' }}" data-tab="{{ $k }}">{{ __(ucfirst($k)) }}</button>
                    @endforeach
                </div>
            </div>
            <div class="col-span-5">
                @foreach ($aircraftTabs as $k => $items)
                    <ul class="space-y-1" data-tab-panel="{{ $k }}" @unless ($loop->first) hidden @endunless>
                        @foreach ($items as [$name, $type])
                            @php
                                $ac = $aircraftByName[$name] ?? null;
                                $specLine = $ac ? collect($ac['specs'])->map(fn ($s) => $s[0] . ' ' . $s[1])->implode(' · ') : '';
                            @endphp
                            <li data-preview
                                data-href="{{ route('aircraft.show', \Illuminate\Support\Str::slug($name)) }}"
                                data-image="{{ $ac['image'] ?? $aircraft[0]['image'] }}?auto=format&fit=crop&w=900&q=75"
                                data-eyebrow="{{ $type }}"
                                data-title="{{ $name }}"
                                data-desc="{{ $specLine }}">
                                <a href="{{ route('aircraft.show', \Illuminate\Support\Str::slug($name)) }}" class="menu-link menu-link-rich">
                                    <span class="font-display text-2xl font-semibold uppercase">{{ $name }}</span>
                                    <span class="menu-desc">{{ $type }}</span>
                                    @if ($ac)
                                        <span class="mt-2 flex flex-wrap gap-2">
                                            @foreach ($ac['specs'] as [$sk, $sv])
                                                <span class="spec-chip"><b>{{ $sv }}</b> {{ $sk }}</span>
                                            @endforeach
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
                <div class="mt-8 flex flex-wrap gap-x-8 gap-y-2 border-t border-white/10 pt-6 text-[13px] font-semibold uppercase tracking-[.14em]">
                    <a href="{{ route('contact', ['interest' => 'Aircraft sales']) }}" class="transition hover:text-signal">Build &amp; price</a>
                    <a href="{{ route('aircraft.index') }}" class="transition hover:text-signal">Compare aircraft</a>
                    <a href="{{ route('contact', ['interest' => 'Aircraft sales']) }}#form" class="transition hover:text-signal">Request a demo</a>
                </div>
            </div>
            <div class="col-span-5">
                @include('partials.menu-feature', [
                    'image'   => $aircraft[0]['image'],
                    'eyebrow' => $aircraft[0]['type'],
                    'title'   => $aircraft[0]['name'],
                    'desc'    => collect($aircraft[0]['specs'])->map(fn ($s) => $s[0] . ' ' . $s[1])->implode(' · '),
                    'href'    => route('aircraft.show', $aircraft[0]['slug']),
                ])
            </div>
        </div>
    </div>

    {{-- Mega panel: Solutions (tabs + described links + featured card) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="solutions">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10" data-tabs>
            <div class="col-span-2">
                <p class="menu-eyebrow">{{ __('Solutions') }}</p>
                <div class="mt-4 flex flex-col">
                    @foreach (array_keys($solutionTabs) as $k)
                        <button type="button" class="menu-tab {{ $loop->first ? 'is-active' : '' }}" data-tab="{{ $k }}">{{ __(ucfirst($k)) }}</button>
                    @endforeach
                </div>
            </div>
            <div class="col-span-5">
                @foreach ($solutionTabs as $k => $items)
                    <ul data-tab-panel="{{ $k }}" @unless ($loop->first) hidden @endunless>
                        @foreach ($items as $i)
                            <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => $hint[$i] ?? null, 'big' => true])</li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
            <div class="col-span-5">
                @include('partials.menu-feature', ['image' => $sol[2]['image'], 'eyebrow' => 'Featured mission', 'title' => $sol[2]['title'], 'desc' => $sol[2]['text'], 'href' => route('solutions') . '#air-medical'])
            </div>
        </div>
    </div>

    {{-- Mega panel: Innovation (described links + proof points + featured story) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="innovation">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <div class="col-span-3">
                <p class="font-display text-4xl font-semibold uppercase leading-none">{{ __('Innovation') }}</p>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-steel">The research and technology programs shaping the next generation of flight.</p>
                <dl class="mt-8 space-y-4 border-t border-white/10 pt-6">
                    @foreach ([['1,600 km', 'Hybrid-electric range flown'], ['42 min', 'First full transition flight'], ['30%', 'Lower operating cost, short routes']] as [$sv, $sl])
                        <div class="flex items-baseline gap-4">
                            <dt class="w-24 shrink-0 font-display text-3xl font-semibold text-signal">{{ $sv }}</dt>
                            <dd class="text-[13px] text-white/70">{{ $sl }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
            <ul class="col-span-5">
                @foreach ($innovation as $i)
                    <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => $hint[$i] ?? null, 'big' => true])</li>
                @endforeach
            </ul>
            <div class="col-span-4">
                @include('partials.menu-feature', ['image' => $news[1]['image'], 'eyebrow' => 'From the labs', 'title' => $news[1]['title'], 'desc' => $news[1]['date'], 'href' => route('news.show', $news[1]['slug'])])
            </div>
        </div>
    </div>

    {{-- Mega panel: Support (featured card + grouped columns + 24/7 strip) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="support">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <div class="col-span-4">
                @include('partials.menu-feature', ['image' => $sol[3]['image'], 'eyebrow' => 'Services & support', 'title' => 'Mission-ready, worldwide', 'desc' => 'Maintenance, parts, training and mobile response teams for every Skyforge platform.', 'href' => route('support')])
            </div>
            <div class="col-span-8">
                <div class="grid grid-cols-3 gap-8">
                    @foreach ($support as $group => $items)
                        <div>
                            <p class="menu-eyebrow">{{ $group }}</p>
                            <ul class="mt-3">
                                @foreach ($items as $i)
                                    <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => $hint[$i] ?? null])</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 flex flex-wrap items-center justify-between gap-4 rounded-xl border border-white/10 bg-white/[.03] px-6 py-4">
                    <p class="text-[14px] text-white/80"><span class="font-semibold text-white">Aircraft on ground?</span> Our response desk is staffed around the clock.</p>
                    <a href="{{ route('contact', ['interest' => 'Service & support']) }}" class="rounded-full bg-signal px-5 py-2 text-[12px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Request AOG support</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Mega panel: Careers (described links + job areas with open-role counts) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="careers">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <div class="col-span-4">
                <p class="font-display text-4xl font-semibold uppercase leading-none">{{ __('Careers') }}</p>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-steel">Build the aircraft that move the world forward. Explore roles across the company.</p>
                <a href="{{ route('careers') }}#roles" class="mt-6 inline-flex items-center gap-3 rounded-full border border-white/30 px-5 py-2.5 text-[12px] font-semibold uppercase tracking-[.14em] transition hover:border-signal hover:text-signal">
                    <span class="font-display text-xl leading-none text-signal">{{ count($roles) }}</span> open roles
                </a>
            </div>
            <ul class="col-span-4">
                @foreach ($careers as $i)
                    <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => $hint[$i] ?? null, 'big' => true])</li>
                @endforeach
            </ul>
            <div class="col-span-4">
                <p class="menu-eyebrow">Job areas</p>
                <ul class="mt-3">
                    @foreach ($jobAreas as $i)
                        <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => ($roleCounts[$i] ?? 0) . ' open ' . (($roleCounts[$i] ?? 0) === 1 ? 'role' : 'roles')])</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Mega panel: Company (described links + news links + featured story) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="company">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <ul class="col-span-3">
                @foreach ($company as $i)
                    <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => $hint[$i] ?? null, 'big' => true])</li>
                @endforeach
            </ul>
            <div class="col-span-3">
                <p class="menu-eyebrow">News &amp; events</p>
                <ul class="mt-3">
                    @foreach ($newsLinks as $i)
                        <li>@include('partials.menu-item', ['label' => $i, 'href' => $linkTo($i), 'desc' => $hint[$i] ?? null])</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-span-6">
                @include('partials.menu-feature', ['image' => $news[0]['image'], 'eyebrow' => 'Latest story · ' . $news[0]['date'], 'title' => $news[0]['title'], 'desc' => $news[0]['excerpt'], 'href' => route('news.show', $news[0]['slug'])])
            </div>
        </div>
    </div>
</header>

{{-- Dimmer behind open menus. Sits right after the header so CSS can react to .menu-open --}}
<div class="menu-backdrop" aria-hidden="true"></div>

{{-- Mobile / tablet drawer (kept outside the header so scrolling never shrinks it) --}}
<aside id="mobile-menu" class="fixed inset-y-0 right-0 z-[60] flex w-full max-w-sm flex-col overflow-y-auto bg-navy px-6 py-5 xl:hidden">
    <div class="flex items-center justify-between">
        <span class="font-display text-xl font-bold uppercase tracking-[.14em]">{{ __('Menu') }}</span>
        <button id="mobile-close" class="text-3xl leading-none" aria-label="Close menu">&times;</button>
    </div>

    <nav class="mt-8 flex-1" aria-label="Mobile">
        @foreach ([
            ['Aircraft', array_merge(array_column($aircraftTabs['commercial'], 0), array_column($aircraftTabs['defense'], 0)), route('aircraft.index')],
            ['Solutions', array_merge($solutionTabs['commercial'], $solutionTabs['defense']), route('solutions')],
            ['Innovation', $innovation, route('innovation')],
            ['Support', array_merge(...array_values($support)), route('support')],
            ['Careers', $careers, route('careers')],
            ['Company', array_merge($company, $newsLinks), route('company')],
        ] as [$label, $links, $href])
            <details class="group border-b border-white/10">
                <summary class="flex cursor-pointer list-none items-center justify-between py-5 font-display text-3xl font-semibold uppercase">
                    {{ __($label) }}
                    <svg class="transition group-open:rotate-180" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </summary>
                <ul class="pb-5">
                    @foreach (array_unique($links) as $l)
                        <li><a href="{{ $linkTo($l, $href) }}" class="block py-2 text-[15px] text-white/80">{{ $l }}</a></li>
                    @endforeach
                </ul>
            </details>
        @endforeach
    </nav>

    <div class="mt-8 border-t border-white/10 pt-6">
        <p class="menu-eyebrow">{{ __('Language') }}</p>
        <div class="mt-3 flex flex-wrap gap-2">
            @foreach ($locales as $code => [$langName])
                <a href="{{ route('lang', $code) }}" lang="{{ $code }}" class="chip {{ $code === $locale ? 'is-active' : '' }}">{{ $langName }}</a>
            @endforeach
        </div>

        <p class="menu-eyebrow mt-6">{{ __('Login') }}</p>
        @auth
            <p class="mt-3 text-[15px] text-white/80">{{ auth()->user()->name }}</p>
            <div class="mt-3 flex flex-wrap gap-3">
                <a href="{{ route('portal') }}" class="rounded-full border border-white/30 px-6 py-2.5 text-[13px] font-semibold uppercase tracking-widest">{{ __('Dashboard') }}</a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="rounded-full border border-white/30 px-6 py-2.5 text-[13px] font-semibold uppercase tracking-widest">{{ __('Sign out') }}</button></form>
            </div>
        @else
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach ($portals as $slug => [$pLabel, $pDesc])
                    <a href="{{ route('login', $slug) }}" class="chip">{{ __($pLabel) }}</a>
                @endforeach
            </div>
            <a href="{{ route('register') }}" class="mt-3 inline-block text-[14px] text-white/70 underline">{{ __('Create an account') }}</a>
        @endauth
    </div>

    <div class="mt-8 flex flex-wrap items-center gap-3">
        <a href="{{ route('contact') }}" class="rounded-full bg-signal px-7 py-3 text-[13px] font-semibold uppercase tracking-widest">{{ __('Contact Sales') }}</a>
        <button type="button" data-search-open class="rounded-full border border-white/30 px-7 py-3 text-[13px] font-semibold uppercase tracking-widest">{{ __('Search') }}</button>
    </div>
</aside>

{{-- Search overlay --}}
<div id="search-overlay" class="fixed inset-0 z-[70] bg-navy/[.97] px-6" role="dialog" aria-modal="true" aria-label="Search">
    <div class="mx-auto flex h-full max-w-3xl flex-col justify-center">
        <button type="button" data-search-close class="absolute right-6 top-6 text-4xl leading-none lg:right-10 lg:top-8" aria-label="Close search">&times;</button>
        <p class="menu-eyebrow">Search Skyforge</p>
        <form action="{{ route('search') }}" method="GET" role="search" class="mt-6 flex items-center gap-4 border-b border-white/30 pb-4">
            <input type="search" name="q" aria-label="Search" placeholder="Search aircraft, solutions, news..." class="w-full bg-transparent font-display text-4xl font-semibold uppercase placeholder-white/30 outline-none sm:text-6xl">
            <button type="submit" class="shrink-0 text-signal" aria-label="Submit search">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            </button>
        </form>
        <p class="mt-6 text-sm text-steel">Popular: <a class="underline transition hover:text-white" href="{{ route('aircraft.show', 'sf-200-vanguard') }}">SF-200 Vanguard</a>, <a class="underline transition hover:text-white" href="{{ route('search', ['q' => 'hybrid']) }}">Hybrid-electric</a>, <a class="underline transition hover:text-white" href="{{ route('support') }}#training">Pilot training</a>, <a class="underline transition hover:text-white" href="{{ route('careers') }}">Careers</a></p>
    </div>
</div>
