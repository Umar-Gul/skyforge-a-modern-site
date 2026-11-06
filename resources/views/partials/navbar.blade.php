@php
    $aircraft = config('skyforge.aircraft');
    $sol = config('skyforge.solutions');
    $news = config('skyforge.news');

    // key, label, link
    $nav = [
        ['aircraft', 'Aircraft', route('aircraft.index')],
        ['solutions', 'Solutions', route('solutions')],
        ['innovation', 'Innovation', route('innovation')],
        ['support', 'Support', route('support')],
        ['careers', 'Careers', route('careers')],
        ['company', 'Company', route('company')],
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
    $languages = ['English', 'Español', 'Français', 'Deutsch', 'Português', 'العربية'];
    $login = ['Customer portal', 'Supplier portal', 'Employee portal'];

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
            <div class="relative hidden h-20 items-center xl:flex">
                <button type="button" class="inline-flex items-center gap-1.5 px-3 py-2 text-[12.5px] font-medium uppercase tracking-[.12em] text-white/90 transition hover:text-white" data-menu-trigger="lang" aria-expanded="false">
                    EN
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="mega-panel absolute left-0 top-full hidden w-56 rounded-b-xl border border-t-0 border-white/10 bg-navy p-5 xl:block" data-menu-panel="lang">
                    <p class="menu-eyebrow">Language</p>
                    <ul class="mt-3">
                        @foreach ($languages as $l)
                            <li>@if ($loop->first)<span class="menu-link pointer-events-none text-white" aria-current="true">{{ $l }}</span>@else<span class="menu-link pointer-events-none opacity-40" title="Coming soon">{{ $l }}</span>@endif</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="relative hidden h-20 items-center xl:flex">
                <button type="button" class="inline-flex items-center gap-1.5 px-3 py-2 text-[12.5px] font-medium uppercase tracking-[.12em] text-white/90 transition hover:text-white" data-menu-trigger="login" aria-expanded="false">
                    Login
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="mega-panel absolute left-0 top-full hidden w-56 rounded-b-xl border border-t-0 border-white/10 bg-navy p-5 xl:block" data-menu-panel="login">
                    <p class="menu-eyebrow">Sign in</p>
                    <ul class="mt-3">
                        @foreach ($login as $l)
                            <li><span class="menu-link pointer-events-none opacity-40" title="Coming soon">{{ $l }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="button" class="flex h-10 w-10 items-center justify-center rounded-full transition hover:bg-white/10" data-search-open data-menu-none aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            </button>

            <a href="{{ route('contact') }}" data-menu-none class="ml-2 hidden rounded-full bg-signal px-6 py-2.5 text-[12.5px] font-semibold uppercase tracking-[.12em] transition hover:bg-white hover:text-navy xl:inline-block">
                Contact Sales
            </a>

            <button id="burger" class="flex h-10 w-10 flex-col items-center justify-center gap-1.5 xl:hidden" aria-label="Open menu">
                <span class="h-0.5 w-6 bg-white"></span>
                <span class="h-0.5 w-6 bg-white"></span>
                <span class="h-0.5 w-4 self-end bg-white"></span>
            </button>
        </div>
    </div>

    {{-- Mega panel: Aircraft (tabs + model list + featured card) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="aircraft">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10" data-tabs>
            <div class="col-span-2">
                <p class="menu-eyebrow">Aircraft</p>
                <div class="mt-4 flex flex-col">
                    @foreach (array_keys($aircraftTabs) as $k)
                        <button type="button" class="menu-tab {{ $loop->first ? 'is-active' : '' }}" data-tab="{{ $k }}">{{ ucfirst($k) }}</button>
                    @endforeach
                </div>
            </div>
            <div class="col-span-5">
                @foreach ($aircraftTabs as $k => $items)
                    <ul class="space-y-1" data-tab-panel="{{ $k }}" @unless ($loop->first) hidden @endunless>
                        @foreach ($items as [$name, $type])
                            <li>
                                <a href="{{ route('aircraft.show', \Illuminate\Support\Str::slug($name)) }}" class="menu-link">
                                    <span class="font-display text-2xl font-semibold uppercase">{{ $name }}</span>
                                    <span class="block text-sm text-steel">{{ $type }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
                <div class="mt-8 flex flex-wrap gap-x-8 gap-y-2 border-t border-white/10 pt-6 text-[13px] font-semibold uppercase tracking-[.14em]">
                    <a href="{{ route('contact', ['interest' => 'Aircraft sales']) }}" class="transition hover:text-signal">Build &amp; price</a>
                    <a href="{{ route('aircraft.index') }}" class="transition hover:text-signal">Compare aircraft</a>
                    <a href="#newsletter" class="transition hover:text-signal">Newsletter</a>
                </div>
            </div>
            <div class="col-span-5">
                @include('partials.menu-feature', ['image' => $aircraft[0]['image'], 'eyebrow' => 'Featured aircraft', 'title' => $aircraft[0]['name'], 'href' => route('aircraft.index')])
            </div>
        </div>
    </div>

    {{-- Mega panel: Solutions (tabs + link list + featured card) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="solutions">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10" data-tabs>
            <div class="col-span-2">
                <p class="menu-eyebrow">Solutions</p>
                <div class="mt-4 flex flex-col">
                    @foreach (array_keys($solutionTabs) as $k)
                        <button type="button" class="menu-tab {{ $loop->first ? 'is-active' : '' }}" data-tab="{{ $k }}">{{ ucfirst($k) }}</button>
                    @endforeach
                </div>
            </div>
            <div class="col-span-5">
                @foreach ($solutionTabs as $k => $items)
                    <ul data-tab-panel="{{ $k }}" @unless ($loop->first) hidden @endunless>
                        @foreach ($items as $i)
                            <li><a href="{{ $linkTo($i) }}" class="menu-link font-display text-2xl font-semibold uppercase">{{ $i }}</a></li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
            <div class="col-span-5">
                @include('partials.menu-feature', ['image' => $sol[2]['image'], 'eyebrow' => 'Featured mission', 'title' => $sol[2]['title'], 'href' => route('solutions') . '#air-medical'])
            </div>
        </div>
    </div>

    {{-- Mega panel: Innovation (short link list, no images) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="innovation">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <div class="col-span-4">
                <p class="font-display text-4xl font-semibold uppercase leading-none">Innovation</p>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-steel">The research and technology programs shaping the next generation of flight.</p>
            </div>
            <ul class="col-span-8 grid grid-cols-2 gap-x-10">
                @foreach ($innovation as $i)
                    <li><a href="{{ $linkTo($i) }}" class="menu-link font-display text-2xl font-semibold uppercase">{{ $i }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Mega panel: Support (featured card + grouped columns) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="support">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <div class="col-span-4">
                @include('partials.menu-feature', ['image' => $sol[3]['image'], 'eyebrow' => 'Services & support', 'title' => 'Mission-ready, worldwide', 'href' => route('support')])
            </div>
            <div class="col-span-8 grid grid-cols-3 gap-8">
                @foreach ($support as $group => $items)
                    <div>
                        <p class="menu-eyebrow">{{ $group }}</p>
                        <ul class="mt-3">
                            @foreach ($items as $i)
                                <li><a href="{{ $linkTo($i) }}" class="menu-link">{{ $i }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Mega panel: Careers (links + job areas) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="careers">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <div class="col-span-4">
                <p class="font-display text-4xl font-semibold uppercase leading-none">Careers</p>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-steel">Build the aircraft that move the world forward. Explore roles across the company.</p>
            </div>
            <ul class="col-span-4">
                @foreach ($careers as $i)
                    <li><a href="{{ $linkTo($i) }}" class="menu-link font-display text-2xl font-semibold uppercase">{{ $i }}</a></li>
                @endforeach
            </ul>
            <div class="col-span-4">
                <p class="menu-eyebrow">Job areas</p>
                <ul class="mt-3">
                    @foreach ($jobAreas as $i)
                        <li><a href="{{ $linkTo($i) }}" class="menu-link">{{ $i }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Mega panel: Company (links + news list + featured story) --}}
    <div class="mega-panel absolute left-0 top-full hidden w-full border-t border-white/10 bg-navy xl:block" data-menu-panel="company">
        <div class="mx-auto grid max-w-[1440px] grid-cols-12 gap-10 px-10 py-10">
            <ul class="col-span-3">
                @foreach ($company as $i)
                    <li><a href="{{ $linkTo($i) }}" class="menu-link font-display text-2xl font-semibold uppercase">{{ $i }}</a></li>
                @endforeach
            </ul>
            <div class="col-span-3">
                <p class="menu-eyebrow">News &amp; events</p>
                <ul class="mt-3">
                    @foreach ($newsLinks as $i)
                        <li><a href="{{ $linkTo($i) }}" class="menu-link">{{ $i }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-span-6">
                @include('partials.menu-feature', ['image' => $news[0]['image'], 'eyebrow' => 'Latest story', 'title' => $news[0]['title'], 'href' => route('news.show', $news[0]['slug'])])
            </div>
        </div>
    </div>
</header>

{{-- Dimmer behind open menus. Sits right after the header so CSS can react to .menu-open --}}
<div class="menu-backdrop" aria-hidden="true"></div>

{{-- Mobile / tablet drawer (kept outside the header so scrolling never shrinks it) --}}
<aside id="mobile-menu" class="fixed inset-y-0 right-0 z-[60] flex w-full max-w-sm flex-col overflow-y-auto bg-navy px-6 py-5 xl:hidden">
    <div class="flex items-center justify-between">
        <span class="font-display text-xl font-bold uppercase tracking-[.14em]">Menu</span>
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
                    {{ $label }}
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

    <div class="mt-8 flex flex-wrap items-center gap-3">
        <a href="{{ route('contact') }}" class="rounded-full bg-signal px-7 py-3 text-[13px] font-semibold uppercase tracking-widest">Contact Sales</a>
        <button type="button" data-search-open class="rounded-full border border-white/30 px-7 py-3 text-[13px] font-semibold uppercase tracking-widest">Search</button>
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
