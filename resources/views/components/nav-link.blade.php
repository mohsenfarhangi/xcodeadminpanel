@props(['active'])

@php
$classes = ($active ?? false)
            ? 'menu menu-item active'
            : 'menu menu-item';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
