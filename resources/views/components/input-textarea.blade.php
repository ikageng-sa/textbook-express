@props(['name', 'class' => 'form-control border-success-subtle'])
<textarea class="{{ $class }}" 
    @isset($autocomplete) autocomplete='on' @endisset 
    @isset($required) required @endisset
    @isset($model) wire:model="{{ $name }}" @endisset
    name="{{ $name }}" rows="3">{{ $slot }}</textarea>