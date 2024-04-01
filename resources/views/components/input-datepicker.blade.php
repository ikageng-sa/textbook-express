@props(['name', 'value' => ''])
<input id="{{ $name }}" 
    type="date" 
    class="form-control border-success-subtle @error($name) is-invalid @enderror" 
    name="{{ $name }}" value="{{ old($name) ?? $value }}">