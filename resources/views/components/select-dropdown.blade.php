@props(['name', 'options'])
<select name ="{{ $name }}" 
    class="form-select border-success-subtle @error($name) is-invalid @enderror"
    @isset($autocomplete) autocomplete='on' @endisset 
    @isset($required) required @endisset
    @isset($model) wire:model="{{ $name }}" @endisset>
    <option selected disabled>Select a {{ strtolower($name) }}</option>
    @forelse (explode(', ', $options) as $option)
    <option value="{{ strtolower($option) }}">{{ ucfirst($option)  }}</option>
    @empty
    <option></option>
    @endforelse
</select>