<section class="relative overflow-hidden bg-navy-2 py-28 lg:py-44">
    <img data-parallax src="{{ config('skyforge.cta_image') }}?auto=format&fit=crop&w=2400&q=75" alt="" aria-hidden="true"
         class="absolute inset-x-0 -top-[10%] h-[120%] w-full object-cover" loading="lazy">
    <div class="absolute inset-0 bg-gradient-to-r from-navy/90 via-navy/70 to-navy/40"></div>

    <div data-reveal class="relative mx-auto max-w-[1440px] px-6 lg:px-10">
        <p class="text-[13px] font-semibold uppercase tracking-[.3em] text-signal">Work with us</p>
        <h2 class="mt-5 max-w-4xl font-display text-6xl font-bold uppercase leading-[.92] sm:text-7xl lg:text-[8rem]">
            Let&rsquo;s build<br>what&rsquo;s next.
        </h2>
        <p class="mt-8 max-w-xl text-lg leading-relaxed text-white/80">
            Talk to our team about the right aircraft for your mission, or join the engineers building the next generation of flight.
        </p>
        <div class="mt-10 flex flex-wrap gap-4">
            <a href="{{ route('contact') }}" class="rounded-full bg-signal px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:bg-white hover:text-navy">Contact Sales</a>
            <a href="{{ route('careers') }}" class="rounded-full border border-white/40 px-8 py-3.5 text-[13px] font-semibold uppercase tracking-[.14em] transition hover:border-white hover:bg-white/10">Explore Careers</a>
        </div>
    </div>
</section>
