<div>
    <button type="button" wire:click="add()" class="btn btn-success {{ $class }}">
        <i wire:loading.remove class="bi bi-cart"></i>
        <div wire:loading class="spinner" style="height:1rem;width:1rem;"></div>
    </button>
</div>
