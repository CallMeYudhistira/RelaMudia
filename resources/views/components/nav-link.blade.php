@props(['active' => false])

<a {{ $attributes->merge(['class' => $active ? 'text-teal-500 hover:text-teal-700 font-bold' : '']) }}>{{ $slot }}</a>
