@props(['required', 'model', 'name', 'type' => 'text', 'value' => '', 'class' => 'form-control border-success-subtle', 'checked', 'autocomplete'])

<input id="{{ $name }}" 
    type="{{ $type }}"
    class="{{ $class }}  @error($name) is-invalid @enderror" 
    name="{{ $name }}" 
    value="{{ old($name) ?? $value }}" 
    @isset($autocomplete) autocomplete='{{ $autocomplete }}' @endisset 
    @isset($required) required @endisset 
    @isset($model) wire:model="{{ $name }}" @endisset>