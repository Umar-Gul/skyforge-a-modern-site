<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

/* ---------- Aircraft ---------- */
Route::view('/aircraft', 'pages.aircraft')->name('aircraft.index');

Route::get('/aircraft/{slug}', function (string $slug) {
    $all = collect(config('skyforge.aircraft'));
    $aircraft = $all->firstWhere('slug', $slug);
    abort_unless($aircraft, 404);

    return view('pages.aircraft-show', [
        'aircraft' => $aircraft,
        'details'  => config("skyforge.aircraft_details.$slug", []),
        'others'   => $all->where('slug', '!=', $slug)->values()->all(),
    ]);
})->name('aircraft.show');

/* ---------- Main sections ---------- */
Route::view('/solutions', 'pages.solutions')->name('solutions');
Route::view('/innovation', 'pages.innovation')->name('innovation');
Route::view('/support', 'pages.support')->name('support');
Route::view('/company', 'pages.company')->name('company');

Route::get('/careers', function (Request $request) {
    return view('pages.careers', ['area' => $request->query('area')]);
})->name('careers');

/* ---------- News ---------- */
Route::get('/news', function (Request $request) {
    return view('pages.news', ['filter' => $request->query('tag', 'all')]);
})->name('news.index');

Route::get('/news/{slug}', function (string $slug) {
    $all = collect(config('skyforge.news'));
    $story = $all->firstWhere('slug', $slug);
    abort_unless($story, 404);

    return view('pages.news-show', [
        'story'  => $story,
        'others' => $all->where('slug', '!=', $slug)->take(3)->values()->all(),
    ]);
})->name('news.show');

/* ---------- Search ---------- */
Route::get('/search', function (Request $request) {
    $q = trim((string) $request->query('q', ''));
    $needle = mb_strtolower($q);
    $results = [];

    if (mb_strlen($q) >= 2) {
        $match = fn (string ...$parts) => str_contains(mb_strtolower(implode(' ', $parts)), $needle);

        foreach (config('skyforge.aircraft') as $a) {
            $summary = config("skyforge.aircraft_details.{$a['slug']}.summary", '');
            if ($match($a['name'], $a['type'], $summary)) {
                $results[] = ['Aircraft', $a['name'], $a['type'], route('aircraft.show', $a['slug'])];
            }
        }

        foreach ([
            ['Solutions', 'Missions: regional transport, cargo, air medical, vertical lift, surveillance and logistics support', route('solutions')],
            ['Innovation', 'Autonomy and avionics, hybrid-electric power, advanced composites, Skyforge Labs, sustainability', route('innovation')],
            ['Support & training', 'Maintenance programs, spare parts, technical publications, pilot training, maintainer training, simulators, service centers, warranty, flight safety', route('support')],
            ['Careers', 'Open roles in engineering, manufacturing, flight operations, business and finance, early careers, benefits', route('careers')],
            ['Company', 'About us, mission, values, timeline, leadership', route('company')],
            ['Contact', 'Sales, support and media enquiries', route('contact')],
        ] as [$title, $desc, $url]) {
            if ($match($title, $desc)) {
                $results[] = ['Page', $title, $desc, $url];
            }
        }

        foreach (config('skyforge.news') as $n) {
            if ($match($n['title'], $n['excerpt'], $n['tag'])) {
                $results[] = ['News', $n['title'], $n['date'], route('news.show', $n['slug'])];
            }
        }
    }

    return view('pages.search', compact('q', 'results'));
})->name('search');

/* ---------- Contact ---------- */
Route::view('/contact', 'pages.contact')->name('contact');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name'     => ['required', 'string', 'max:120'],
        'email'    => ['required', 'email', 'max:160'],
        'company'  => ['nullable', 'string', 'max:160'],
        'interest' => ['required', 'string', 'max:80'],
        'message'  => ['required', 'string', 'min:10', 'max:3000'],
        'website'  => ['prohibited'], // honeypot: real visitors leave it empty
    ]);

    // No mail server is configured yet, so enquiries are written to storage/logs/laravel.log
    Log::info('Skyforge contact enquiry', $data);

    return redirect()->route('contact')->with('sent', true);
})->middleware('throttle:5,1')->name('contact.send');

/* ---------- Legal ---------- */
Route::view('/privacy', 'pages.legal', ['doc' => 'privacy'])->name('legal.privacy');
Route::view('/terms', 'pages.legal', ['doc' => 'terms'])->name('legal.terms');
