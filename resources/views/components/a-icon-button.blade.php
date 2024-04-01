<a href="{{ $route ?? '#' }}" class="{{ $class }}"
@isset($preventDefault) onclick="event.preventDefault();"@endisset >
    <span class="bi bi-{{ $icon }} "></span>
    {{ $slot }}
</a>