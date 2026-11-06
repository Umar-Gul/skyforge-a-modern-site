@extends('layouts.app')

@php
    $docs = [
        'privacy' => ['Privacy Policy', [
            ['Information we collect', 'When you contact us or subscribe to updates we collect the details you provide, such as your name, email address, company and message. We also collect basic technical data, such as browser type and pages visited, to keep the site working well.'],
            ['How we use it', 'We use your information to answer enquiries, send updates you asked for, and improve our website and services. We do not sell your personal information.'],
            ['Sharing', 'We share information only with service providers who help us run the site and respond to you, and where the law requires it.'],
            ['Your choices', 'You can ask to access, correct or delete your information, or unsubscribe from updates, at any time by contacting us.'],
            ['Contact', 'Questions about this policy can be sent through the contact page.'],
        ]],
        'terms' => ['Terms of Use', [
            ['Using this site', 'By using this website you agree to these terms. The content is provided for general information and may change without notice.'],
            ['Intellectual property', 'Text, graphics and design on this site belong to Skyforge Aviation or its licensors. Photography is provided by Unsplash contributors under the Unsplash License, and video clips by Mixkit under the Mixkit License.'],
            ['No warranty', 'The site is provided as is. Specifications and performance figures are illustrative and do not form an offer or contract.'],
            ['Limitation of liability', 'To the fullest extent permitted by law, Skyforge Aviation is not liable for losses arising from use of this site.'],
            ['Changes', 'We may update these terms from time to time. Continued use of the site means you accept the updated terms.'],
        ]],
    ];
    [$heading, $sections] = $docs[$doc];
@endphp

@section('title', $heading . ' | Skyforge Aviation')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Legal',
        'crumb'   => $heading,
        'title'   => $heading,
    ])

    <section class="bg-navy pb-24 lg:pb-32">
        <div class="mx-auto max-w-3xl space-y-10 px-6 lg:px-10">
            @foreach ($sections as [$title, $text])
                <div data-reveal>
                    <h2 class="font-display text-3xl font-semibold uppercase leading-none">{{ $title }}</h2>
                    <p class="mt-4 text-[17px] leading-relaxed text-white/75">{{ $text }}</p>
                </div>
            @endforeach
            <p class="border-t border-white/10 pt-6 text-xs text-steel">Skyforge Aviation is a fictional brand. This is sample text for design practice and is not legal advice. Last updated November 2026.</p>
        </div>
    </section>
@endsection
