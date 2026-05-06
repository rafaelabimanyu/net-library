@props(['active', 'href'])

@php
$classes = ($active ?? false)
            ? 'text-sm font-bold text-sky-blue neon-text uppercase tracking-widest transition-all duration-300'
            : 'text-sm font-medium text-gray-500 dark:text-white/40 hover:text-sky-blue dark:hover:text-white transition-all duration-300 uppercase tracking-widest';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
