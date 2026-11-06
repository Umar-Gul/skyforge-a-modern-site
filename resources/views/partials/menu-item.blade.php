{{-- Menu link with an optional one-line description. Vars: $label, $href, $desc (optional), $big (optional, display type) --}}
<a href="{{ $href }}" class="menu-link menu-link-rich">
    <span class="{{ ! empty($big) ? 'font-display text-2xl font-semibold uppercase' : 'font-medium' }}">{{ $label }}</span>
    @if (! empty($desc))
        <span class="menu-desc">{{ $desc }}</span>
    @endif
</a>
