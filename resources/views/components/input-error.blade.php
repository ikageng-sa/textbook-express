@props(['message', 'name'])

@error($name)
    <span class="text-danger" role="alert">
        <strong><small>{{ $message }}</small></strong>
    </span>
@enderror
