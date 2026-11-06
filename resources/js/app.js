import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
if (reduceMotion) document.documentElement.classList.remove('js');

const header = document.getElementById('site-header');

/* ---------- Navbar: solid on scroll ---------- */
const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 40);
onScroll();
window.addEventListener('scroll', onScroll, { passive: true });

/* ---------- Mega menu (desktop) ---------- */
const triggers = document.querySelectorAll('[data-menu-trigger]');
const plainLinks = document.querySelectorAll('[data-menu-none]');
const panels = document.querySelectorAll('[data-menu-panel]');
let closeTimer;

function openMenu(name) {
    clearTimeout(closeTimer);
    panels.forEach(p => p.classList.toggle('is-open', p.dataset.menuPanel === name));
    triggers.forEach(t => t.setAttribute('aria-expanded', String(t.dataset.menuTrigger === name)));
    header.classList.toggle('menu-open', Boolean(name));
}
function closeMenu() { closeTimer = setTimeout(() => openMenu(null), 120); }

triggers.forEach(t => t.addEventListener('mouseenter', () => openMenu(t.dataset.menuTrigger)));
plainLinks.forEach(l => l.addEventListener('mouseenter', () => openMenu(null)));
header.addEventListener('mouseleave', closeMenu);
document.addEventListener('keydown', e => e.key === 'Escape' && openMenu(null));
panels.forEach(p => p.querySelectorAll('a').forEach(a => a.addEventListener('click', () => openMenu(null))));

/* ---------- Mobile drawer ---------- */
const burger = document.getElementById('burger');
const mobileMenu = document.getElementById('mobile-menu');
const mobileClose = document.getElementById('mobile-close');
const toggleMobile = open => {
    mobileMenu.classList.toggle('is-open', open);
    document.body.style.overflow = open ? 'hidden' : '';
};
burger?.addEventListener('click', () => toggleMobile(true));
mobileClose?.addEventListener('click', () => toggleMobile(false));
mobileMenu?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => toggleMobile(false)));

/* ---------- Hero slider ---------- */
function initHero() {
    const root = document.getElementById('hero');
    if (!root) return;

    const slides = gsap.utils.toArray('[data-slide]', root);
    const btns = gsap.utils.toArray('[data-bar-btn]', root);
    const fills = gsap.utils.toArray('[data-bar-fill]', root);
    const current = root.querySelector('[data-current]');
    const SLIDE_TIME = 7; // seconds per slide

    let index = 0;
    let busy = false;
    let progress = null;
    let paused = false;

    const texts = i => slides[i].querySelectorAll('.s-anim');
    const img = i => slides[i].querySelector('[data-slide-img]');
    const video = i => slides[i].querySelector('[data-slide-video]');

    /* Background video: muted + inline so browsers allow autoplay. Skipped for reduced motion and data-saver. */
    const canPlayVideo = !reduceMotion && !(navigator.connection && navigator.connection.saveData);
    slides.forEach((_, n) => {
        const v = video(n);
        if (!v) return;
        v.muted = true;
        v.addEventListener('playing', () => v.classList.add('is-ready'));
    });
    const playVideo = i => {
        const v = canPlayVideo && !paused ? video(i) : null;
        if (v) v.play().catch(() => {});
    };

    const setBars = i => {
        btns.forEach((b, n) => b.classList.toggle('is-active', n === i));
        fills.forEach((f, n) => gsap.set(f, { scaleX: n < i ? 1 : 0 }));
    };

    const kenBurns = i => gsap.fromTo(img(i), { scale: 1.08 }, { scale: 1, duration: SLIDE_TIME + 1.5, ease: 'none' });

    const startProgress = () => {
        progress?.kill();
        if (reduceMotion) return;
        progress = gsap.fromTo(fills[index], { scaleX: 0 }, {
            scaleX: 1, duration: SLIDE_TIME, ease: 'none', onComplete: () => go(index + 1),
        });
        if (paused) progress.pause();
    };

    function go(to) {
        to = (to + slides.length) % slides.length;
        if (to === index || busy) return;
        busy = true;

        const from = index;
        index = to;
        progress?.kill();
        setBars(to);
        playVideo(to);
        if (current) current.textContent = String(to + 1).padStart(2, '0');

        const d = reduceMotion ? 0 : 1.1;
        gsap.set(slides[to], { zIndex: 2 });
        gsap.set(slides[from], { zIndex: 1 });

        const tl = gsap.timeline({
            onComplete: () => {
                gsap.set(slides[from], { autoAlpha: 0, zIndex: 0 });
                gsap.killTweensOf(img(from));
                video(from)?.pause();
                busy = false;
                startProgress();
            },
        });

        tl.to(texts(from), { y: -20, opacity: 0, duration: d * 0.4, stagger: 0.04, ease: 'power2.in' }, 0)
            .fromTo(slides[to], { autoAlpha: 0 }, { autoAlpha: 1, duration: d, ease: 'power2.inOut' }, 0.1)
            .fromTo(texts(to), { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: reduceMotion ? 0 : 0.9, stagger: 0.1, ease: 'power3.out' }, d * 0.45);

        if (!reduceMotion) kenBurns(to);
    }

    /* Intro */
    setBars(0);
    gsap.set(slides[0], { zIndex: 2 });
    if (!reduceMotion) {
        kenBurns(0);
        gsap.fromTo(texts(0), { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 1, stagger: 0.12, ease: 'power3.out', delay: 0.2 });
        gsap.from('[data-hero-ui]', { opacity: 0, y: 20, duration: 1, delay: 0.9 });
    }
    startProgress();
    playVideo(0);

    /* Pause / play (slideshow + video) */
    const pauseBtn = root.querySelector('[data-pause]');
    pauseBtn?.addEventListener('click', () => {
        paused = !paused;
        pauseBtn.classList.toggle('is-paused', paused);
        pauseBtn.setAttribute('aria-pressed', String(paused));
        pauseBtn.setAttribute('aria-label', paused ? 'Play slideshow and video' : 'Pause slideshow and video');
        progress?.paused(paused);
        if (paused) video(index)?.pause(); else playVideo(index);
    });

    /* Save battery and bandwidth: stop while the hero is off screen or the tab is hidden */
    const holdOffscreen = hold => {
        if (paused) return;
        progress?.paused(hold);
        if (hold) video(index)?.pause(); else playVideo(index);
    };
    new IntersectionObserver(([e]) => holdOffscreen(!e.isIntersecting), { threshold: 0.15 }).observe(root);
    document.addEventListener('visibilitychange', () => holdOffscreen(document.hidden));

    /* Controls */
    root.querySelector('[data-prev]')?.addEventListener('click', () => go(index - 1));
    root.querySelector('[data-next]')?.addEventListener('click', () => go(index + 1));
    btns.forEach((b, n) => b.addEventListener('click', () => go(n)));

    let startX = 0;
    root.addEventListener('pointerdown', e => { startX = e.clientX; });
    root.addEventListener('pointerup', e => {
        const dx = e.clientX - startX;
        if (Math.abs(dx) > 60) go(index + (dx < 0 ? 1 : -1));
    });

    document.addEventListener('keydown', e => {
        if (e.target instanceof HTMLInputElement) return;
        if (window.scrollY > window.innerHeight * 0.5) return;
        if (e.key === 'ArrowRight') go(index + 1);
        if (e.key === 'ArrowLeft') go(index - 1);
    });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) progress?.pause(); else progress?.resume();
    });
}
initHero();

/* ---------- Scroll reveals (batched so neighbours stagger) ---------- */
if (!reduceMotion) {
    ScrollTrigger.batch('[data-reveal]', {
        start: 'top 88%',
        once: true,
        onEnter: batch => {
            gsap.to(batch, { opacity: 1, y: 0, duration: 0.9, stagger: 0.12, ease: 'power3.out', overwrite: true });
            batch.forEach(el => el.classList.add('is-in'));
        },
    });
}

/* ---------- Aircraft carousel buttons ---------- */
const track = document.getElementById('fleet-track');
if (track) {
    const step = () => (track.querySelector('.aircraft-card')?.offsetWidth ?? 420) + 24;
    document.getElementById('fleet-prev')?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
    document.getElementById('fleet-next')?.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));
}

/* ---------- Stats count-up ---------- */
document.querySelectorAll('[data-count]').forEach(el => {
    const end = parseFloat(el.dataset.count);
    const decimals = parseInt(el.dataset.decimals || '0', 10);
    const fmt = v => v.toLocaleString('en-US', { minimumFractionDigits: decimals, maximumFractionDigits: decimals });

    if (reduceMotion) { el.textContent = fmt(end); return; }

    const counter = { v: 0 };
    el.textContent = fmt(0);
    ScrollTrigger.create({
        trigger: el,
        start: 'top 92%',
        once: true,
        onEnter: () => gsap.to(counter, {
            v: end, duration: 2.2, ease: 'power2.out',
            onUpdate: () => { el.textContent = fmt(counter.v); },
        }),
    });
});

/* ---------- Statement: words light up as you scroll ---------- */
document.querySelectorAll('[data-words]').forEach(el => {
    const words = el.textContent.trim().split(/\s+/);
    el.textContent = '';
    const spans = words.map((w, i) => {
        const s = document.createElement('span');
        s.className = 'word';
        s.textContent = w;
        el.appendChild(s);
        if (i < words.length - 1) el.appendChild(document.createTextNode(' '));
        return s;
    });
    if (reduceMotion) return;
    gsap.fromTo(spans, { opacity: 0.15 }, {
        opacity: 1, stagger: 0.1, ease: 'none',
        scrollTrigger: { trigger: el, start: 'top 80%', end: 'bottom 50%', scrub: true },
    });
});

/* ---------- Solutions: pinned, scroll-driven (desktop only) ---------- */
const mm = gsap.matchMedia();
mm.add('(min-width: 1024px)', () => {
    const pin = document.querySelector('[data-sol-pin]');
    if (!pin || reduceMotion) return;

    const imgs = gsap.utils.toArray('[data-sol-img]', pin);
    const texts = gsap.utils.toArray('[data-sol-text]', pin);
    const items = gsap.utils.toArray('[data-sol-item]', pin);
    const bar = pin.querySelector('[data-sol-progress]');
    const n = imgs.length;

    gsap.set(imgs.slice(1), { autoAlpha: 0 });
    gsap.set(texts.slice(1), { autoAlpha: 0, y: 30 });

    const setActive = i => items.forEach((el, k) => el.classList.toggle('is-active', k === i));
    setActive(0);

    const tl = gsap.timeline({
        defaults: { ease: 'none' },
        scrollTrigger: {
            trigger: pin,
            start: 'top top',
            end: () => '+=' + window.innerHeight * (n - 1) * 0.9,
            pin: true,
            scrub: 0.5,
            anticipatePin: 1,
            invalidateOnRefresh: true,
            onUpdate: self => setActive(Math.round(self.progress * (n - 1))),
        },
    });

    for (let i = 1; i < n; i++) {
        const t = i - 0.5;
        tl.to(imgs[i - 1], { autoAlpha: 0, duration: 0.5 }, t)
            .to(imgs[i], { autoAlpha: 1, duration: 0.5 }, t)
            .to(texts[i - 1], { autoAlpha: 0, y: -30, duration: 0.3 }, t)
            .to(texts[i], { autoAlpha: 1, y: 0, duration: 0.4 }, t + 0.25);
    }
    tl.to({}, { duration: 0.5 }, n - 1); // short hold on the last item
    if (bar) tl.fromTo(bar, { scaleY: 0 }, { scaleY: 1, duration: tl.duration() }, 0);

    return () => items.forEach(el => el.classList.remove('is-active'));
});

/* ---------- Mega menu tabs (Aircraft / Solutions) ---------- */
document.querySelectorAll('[data-tabs]').forEach(group => {
    const tabs = group.querySelectorAll('[data-tab]');
    const panes = group.querySelectorAll('[data-tab-panel]');
    const show = name => {
        tabs.forEach(t => t.classList.toggle('is-active', t.dataset.tab === name));
        panes.forEach(p => { p.hidden = p.dataset.tabPanel !== name; });
    };
    tabs.forEach(t => {
        t.addEventListener('mouseenter', () => show(t.dataset.tab));
        t.addEventListener('click', () => show(t.dataset.tab));
    });
});

/* ---------- Search overlay ---------- */
const searchOverlay = document.getElementById('search-overlay');
const searchInput = searchOverlay?.querySelector('input');
function toggleSearch(open) {
    if (!searchOverlay) return;
    if (!open && !searchOverlay.classList.contains('is-open')) return;
    if (open) { toggleMobile(false); openMenu(null); }
    searchOverlay.classList.toggle('is-open', open);
    document.body.style.overflow = open ? 'hidden' : '';
    if (open) setTimeout(() => searchInput?.focus(), 250);
}
document.querySelectorAll('[data-search-open]').forEach(b => b.addEventListener('click', () => toggleSearch(true)));
document.querySelectorAll('[data-search-close]').forEach(b => b.addEventListener('click', () => toggleSearch(false)));
document.addEventListener('keydown', e => e.key === 'Escape' && toggleSearch(false));

/* ---------- CTA parallax ---------- */
if (!reduceMotion) {
    document.querySelectorAll('[data-parallax]').forEach(img => {
        gsap.fromTo(img, { yPercent: -6 }, {
            yPercent: 6, ease: 'none',
            scrollTrigger: { trigger: img.parentElement, start: 'top bottom', end: 'bottom top', scrub: true },
        });
    });
}

/* ---------- Footer: newsletter + back to top ---------- */
document.querySelectorAll('[data-newsletter]').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        const input = form.querySelector('input');
        const label = btn.textContent;
        input.value = '';
        btn.textContent = 'Subscribed';
        btn.disabled = true;
        setTimeout(() => { btn.textContent = label; btn.disabled = false; }, 3000);
    });
});
document.querySelectorAll('[data-top]').forEach(b => b.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' })));

/* ---------- Filter chips (news, careers) ---------- */
document.querySelectorAll('[data-filter-group]').forEach(group => {
    const chips = group.querySelectorAll('[data-filter]');
    const items = group.querySelectorAll('[data-filter-item]');
    chips.forEach(chip => chip.addEventListener('click', () => {
        const f = chip.dataset.filter;
        chips.forEach(c => c.classList.toggle('is-active', c === chip));
        const shown = [];
        items.forEach(i => {
            const show = f === 'all' || i.dataset.tag === f;
            i.hidden = !show;
            if (show) shown.push(i);
        });
        // items that were hidden never ran their scroll reveal, so bring them in here
        gsap.fromTo(shown, { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.5, stagger: 0.05, ease: 'power2.out', overwrite: true });
        ScrollTrigger.refresh();
    }));
});

window.addEventListener('load', () => ScrollTrigger.refresh());
