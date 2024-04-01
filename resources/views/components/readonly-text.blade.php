@props(['required' => false, 'name' => '', 'autocomplete' => 'off', 'type' => 'text', 'value' => ''])
<input id="{{ $name }}" 
    type="{{ $type }}"
    class="form-control-plaintext fw-bold @error($name) is-invalid @enderror" 
    name="{{ $name }}" 
    value="{{ old($name) ?? $value }}" 
    autocomplete="{{ $autocomplete }}"
    {{ $required || $name=='email' || $name=='password' ? 'required' : '' }}
    readonly>
