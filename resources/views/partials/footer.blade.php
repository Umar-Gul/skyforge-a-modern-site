<footer class="border-t border-white/10 bg-[#070d19]">
    <div class="mx-auto max-w-[1440px] px-6 py-16 lg:px-10 lg:py-20">

        {{-- Row 1: logo + socials | newsletter --}}
        <div class="grid gap-12 lg:grid-cols-12">
            <div class="lg:col-span-6">
                @include('partials.logo')
                <p class="mt-6 max-w-md text-[15px] leading-relaxed text-steel">
                    Next-generation aircraft built for the missions that move the world forward.
                </p>

                <div class="mt-8 flex gap-3">
                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="fleet-btn !h-11 !w-11" aria-label="X">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.3-8.3L2 3h6.4l4.4 5.8L17.5 3Zm-1.1 16.2h1.7L7.7 4.7H5.9l10.5 14.5Z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer" class="fleet-btn !h-11 !w-11" aria-label="LinkedIn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9.75h4V21H3V9.75ZM9.5 9.75h3.8v1.6h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V21h-4v-4.8c0-1.15-.02-2.62-1.6-2.62-1.6 0-1.85 1.25-1.85 2.54V21h-4V9.75Z"/></svg>
                    </a>
                    <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="fleet-btn !h-11 !w-11" aria-label="YouTube">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M21.6 7.2a2.5 2.5 0 0 0-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.5 2.5 0 0 0 2.4 7.2C2 8.8 2 12 2 12s0 3.2.4 4.8a2.5 2.5 0 0 0 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4a2.5 2.5 0 0 0 1.8-1.8c.4-1.6.4-4.8.4-4.8s0-3.2-.4-4.8ZM10 15V9l5.2 3L10 15Z"/></svg>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="fleet-btn !h-11 !w-11" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/></svg>
                    </a>
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="fleet-btn !h-11 !w-11" aria-label="Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-7.5h2.5l.5-3h-3V8.6c0-.9.3-1.5 1.6-1.5h1.6V4.4c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.4-4 4.1v2.1H7.8v3h2.5V21h3.2Z"/></svg>
                    </a>
                </div>
            </div>

            <div id="newsletter" class="lg:col-span-5 lg:col-start-8">
                <p class="font-display text-3xl font-semibold uppercase leading-none">Stay in the loop</p>
                <p class="mt-3 text-sm leading-relaxed text-steel">Get aircraft news, flight-test updates and stories from Skyforge in your inbox.</p>
                <form data-newsletter action="#" class="mt-5 flex flex-col gap-3 sm:flex-row">
                    <input type="email" required placeholder="Email address" aria-label="Email address"
                           class="min-w-0 flex-1 rounded-full border border-white/20 bg-transparent px-6 py-3.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-signal">
                    <button type="submit" class="rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Subscribe</button>
                </form>
            </div>
        </div>

        {{-- Row 2: utility links --}}
        <div class="mt-14 flex flex-wrap gap-x-8 gap-y-3 border-t border-white/10 pt-8 text-[13px] font-medium uppercase tracking-[.14em]">
            @foreach ([
                ['Contact Us', route('contact')],
                ['Aircraft', route('aircraft.index')],
                ['Solutions', route('solutions')],
                ['Innovation', route('innovation')],
                ['Support', route('support')],
                ['Careers', route('careers')],
                ['Company', route('company')],
                ['Newsroom', route('news.index')],
            ] as [$l, $href])
                <a href="{{ $href }}" class="transition hover:text-signal">{{ $l }}</a>
            @endforeach
        </div>

        {{-- Row 3: legal links --}}
        <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-[13px] text-steel">
            <a href="{{ route('legal.privacy') }}" class="transition hover:text-white">Privacy Policy</a>
            <a href="{{ route('legal.terms') }}" class="transition hover:text-white">Terms of Use</a>
            <a href="{{ route('contact') }}" class="transition hover:text-white">Contact</a>
        </div>

        {{-- Row 4: copyright, credits, back to top --}}
        <div class="mt-10 flex flex-wrap items-end justify-between gap-6 border-t border-white/10 pt-8 text-xs leading-relaxed text-steel">
            <div class="max-w-3xl">
                <p>&copy; 2026 Skyforge Aviation. All rights reserved.</p>
                <p class="mt-2">
                    Skyforge Aviation is a fictional brand created for design practice. Photography from Unsplash, including work by
                    Jordy Mu&ntilde;oz, Joel Rivera-Camacho, Byron Breytenbach, Asher Pardey, Cook aynne and Neil Thomas. Hero video clips from Mixkit.
                </p>
            </div>
            <button type="button" data-top class="fleet-btn" aria-label="Back to top">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5m-6 6 6-6 6 6"/></svg>
            </button>
        </div>
    </div>
</footer>
