@props(['route'])
@php
    $isActive = request()->routeIs($route);
    
    $classes = ($isActive) ? 'nav-link active' : 'nav-link';

@endphp
<a {{ $attributes->merge(['class' => $classes]) }} href="{{route($route) }}">
    {{ $slot }}
</a>