@props(['title', 'icon' => null])

<article {{ $attributes->class(['info-card']) }}>
    @if($icon)
        <span class="info-card-icon">@include('partials.icon', ['icon' => $icon])</span>
    @endif
    <div>
        <p class="eyebrow">{{ $title }}</p>
        <div class="info-card-value">{{ $slot }}</div>
    </div>
</article>
