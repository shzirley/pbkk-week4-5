@props(['type' => 'info'])

@php
    $role = in_array($type, ['error', 'warning'], true) ? 'alert' : 'status';
@endphp

<section {{ $attributes->class(['status-banner', 'status-banner-'.$type]) }} role="{{ $role }}">
    <span class="status-banner-mark" aria-hidden="true">{{ $type === 'success' ? '✓' : ($type === 'error' ? '!' : '✦') }}</span>
    <div>
        @isset($title)
            <strong>{{ $title }}</strong>
        @endisset
        <div>{{ $slot }}</div>
    </div>
</section>
