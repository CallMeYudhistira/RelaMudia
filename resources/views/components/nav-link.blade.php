@props(['active' => false, 'mobile' => false])

@php
    $classes = $active
        ? 'text-teal-600 font-bold'
        : 'text-gray-600 hover:text-teal-600';

    $baseClasses = $mobile
        ? 'block px-4 py-3 text-base font-medium transition-colors rounded-xl ' . ($active ? 'bg-teal-50 text-teal-600' : 'hover:bg-gray-50')
        : 'text-sm font-medium transition-colors ' . $classes;
@endphp

<a {{ $attributes->merge(['class' => $baseClasses]) }}>{{ $slot }}</a>
