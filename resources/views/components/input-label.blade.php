@props(['for', 'class' => 'form-label' ])
<label for="{{ $for }}" class="{{ $class }}">{{ $slot }}</label>