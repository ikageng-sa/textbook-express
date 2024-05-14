<div>
    <button type="button" wire:click="add()" class="{{ $class }}" style="{{ $style }}">
        <i wire:loading.remove class="bi bi-cart">@if(!empty($slot)) &nbsp;{{ $slot }} @endif</i>
        <div wire:loading class="spinner" style="height:1rem;width:1rem;"></div>
    </button>
</div>
